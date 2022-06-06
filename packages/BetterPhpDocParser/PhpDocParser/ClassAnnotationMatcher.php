<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\PhpDocParser;

use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Use_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use Rector\CodingStyle\NodeAnalyzer\UseImportNameMatcher;
use Rector\Naming\Naming\UseImportsResolver;
use Rector\NodeTypeResolver\Node\AttributeKey;
/**
 * Matches "@ORM\Entity" to FQN names based on use imports in the file
 */
final class ClassAnnotationMatcher
{
    /**
     * @var array<string, string>
     */
    private $fullyQualifiedNameByHash = [];
    /**
     * @readonly
     * @var \Rector\CodingStyle\NodeAnalyzer\UseImportNameMatcher
     */
    private $useImportNameMatcher;
    /**
     * @readonly
     * @var \Rector\Naming\Naming\UseImportsResolver
     */
    private $useImportsResolver;
    /**
     * @readonly
     * @var \PHPStan\Reflection\ReflectionProvider
     */
    private $reflectionProvider;
    public function __construct(\Rector\CodingStyle\NodeAnalyzer\UseImportNameMatcher $useImportNameMatcher, \Rector\Naming\Naming\UseImportsResolver $useImportsResolver, \PHPStan\Reflection\ReflectionProvider $reflectionProvider)
    {
        $this->useImportNameMatcher = $useImportNameMatcher;
        $this->useImportsResolver = $useImportsResolver;
        $this->reflectionProvider = $reflectionProvider;
    }
    public function resolveTagToKnownFullyQualifiedName(string $tag, \PhpParser\Node $node) : ?string
    {
        return $this->_resolveTagFullyQualifiedName($tag, $node, \true);
    }
    public function resolveTagFullyQualifiedName(string $tag, \PhpParser\Node $node) : ?string
    {
        return $this->_resolveTagFullyQualifiedName($tag, $node, \false);
    }
    private function _resolveTagFullyQualifiedName(string $tag, \PhpParser\Node $node, bool $returnNullOnUnknownClass) : ?string
    {
        $uniqueHash = $tag . \spl_object_hash($node);
        if (isset($this->fullyQualifiedNameByHash[$uniqueHash])) {
            return $this->fullyQualifiedNameByHash[$uniqueHash];
        }
        $tag = \ltrim($tag, '@');
        $uses = $this->useImportsResolver->resolveForNode($node);
        $fullyQualifiedClass = $this->resolveFullyQualifiedClass($uses, $node, $tag, $returnNullOnUnknownClass);
        if ($fullyQualifiedClass === null) {
            if ($returnNullOnUnknownClass) {
                return null;
            }
            $fullyQualifiedClass = $tag;
        }
        $this->fullyQualifiedNameByHash[$uniqueHash] = $fullyQualifiedClass;
        return $fullyQualifiedClass;
    }
    /**
     * @param Use_[]|GroupUse[] $uses
     */
    private function resolveFullyQualifiedClass(array $uses, \PhpParser\Node $node, string $tag, bool $returnNullOnUnknownClass) : ?string
    {
        $scope = $node->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::SCOPE);
        if ($scope instanceof \PHPStan\Analyser\Scope) {
            $namespace = $scope->getNamespace();
            if ($namespace !== null) {
                $namespacedTag = $namespace . '\\' . $tag;
                if ($this->reflectionProvider->hasClass($namespacedTag)) {
                    return $namespacedTag;
                }
                if (\strpos($tag, '\\') === \false) {
                    return $this->resolveAsAliased($uses, $tag, $returnNullOnUnknownClass);
                }
                if (\strncmp($tag, '\\', \strlen('\\')) === 0 && $this->reflectionProvider->hasClass($tag)) {
                    // Global or absolute Class
                    return $tag;
                }
            }
        }
        $class = $this->useImportNameMatcher->matchNameWithUses($tag, $uses);
        return $this->resolveClass($class, $returnNullOnUnknownClass);
    }
    /**
     * @param Use_[]|GroupUse[] $uses
     */
    private function resolveAsAliased(array $uses, string $tag, bool $returnNullOnUnknownClass) : ?string
    {
        foreach ($uses as $use) {
            $prefix = $use instanceof \PhpParser\Node\Stmt\GroupUse ? $use->prefix . '\\' : '';
            foreach ($use->uses as $useUse) {
                if (!$useUse->alias instanceof \PhpParser\Node\Identifier) {
                    continue;
                }
                if ($useUse->alias->toString() === $tag) {
                    $class = $prefix . $useUse->name->toString();
                    return $this->resolveClass($class, $returnNullOnUnknownClass);
                }
            }
        }
        $class = $this->useImportNameMatcher->matchNameWithUses($tag, $uses);
        return $this->resolveClass($class, $returnNullOnUnknownClass);
    }
    private function resolveClass(?string $class, bool $returnNullOnUnknownClass) : ?string
    {
        if (null === $class) {
            return null;
        }
        $resolvedClass = $this->reflectionProvider->hasClass($class) ? $class : null;
        return $returnNullOnUnknownClass ? $resolvedClass : $class;
    }
}
