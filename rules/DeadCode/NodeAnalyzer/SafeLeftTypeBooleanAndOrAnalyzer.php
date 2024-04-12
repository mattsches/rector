<?php

declare (strict_types=1);
namespace Rector\DeadCode\NodeAnalyzer;

use PHPStan\Type\ObjectType;
use PhpParser\Node;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\BinaryOp\BooleanAnd;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticPropertyFetch;
use PhpParser\Node\Expr\Variable;
use PHPStan\Reflection\ClassReflection;
use Rector\NodeAnalyzer\ExprAnalyzer;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\PhpParser\Node\BetterNodeFinder;
use Rector\Reflection\ReflectionResolver;
final class SafeLeftTypeBooleanAndOrAnalyzer
{
    /**
     * @readonly
     * @var \Rector\PhpParser\Node\BetterNodeFinder
     */
    private $betterNodeFinder;
    /**
     * @readonly
     * @var \Rector\NodeAnalyzer\ExprAnalyzer
     */
    private $exprAnalyzer;
    /**
     * @readonly
     * @var \Rector\Reflection\ReflectionResolver
     */
    private $reflectionResolver;
    /**
     * @readonly
     * @var \Rector\NodeTypeResolver\NodeTypeResolver
     */
    private $nodeTypeResolver;
    public function __construct(BetterNodeFinder $betterNodeFinder, ExprAnalyzer $exprAnalyzer, ReflectionResolver $reflectionResolver, NodeTypeResolver $nodeTypeResolver)
    {
        $this->betterNodeFinder = $betterNodeFinder;
        $this->exprAnalyzer = $exprAnalyzer;
        $this->reflectionResolver = $reflectionResolver;
        $this->nodeTypeResolver = $nodeTypeResolver;
    }
    /**
     * @param \PhpParser\Node\Expr\BinaryOp\BooleanAnd|\PhpParser\Node\Expr\BinaryOp\BooleanOr $booleanAnd
     */
    public function isSafe($booleanAnd) : bool
    {
        $hasNonTypedFromParam = (bool) $this->betterNodeFinder->findFirst($booleanAnd->left, function (Node $node) : bool {
            return $node instanceof Variable && $this->exprAnalyzer->isNonTypedFromParam($node);
        });
        if ($hasNonTypedFromParam) {
            return \false;
        }
        $hasPropertyFetchOrArrayDimFetch = (bool) $this->betterNodeFinder->findFirst($booleanAnd->left, static function (Node $node) : bool {
            return $node instanceof PropertyFetch || $node instanceof StaticPropertyFetch || $node instanceof ArrayDimFetch;
        });
        // get type from Property and ArrayDimFetch is unreliable
        if ($hasPropertyFetchOrArrayDimFetch) {
            return \false;
        }
        // skip trait this
        $classReflection = $this->reflectionResolver->resolveClassReflection($booleanAnd);
        if ($classReflection instanceof ClassReflection && $classReflection->isTrait()) {
            return !(bool) $this->betterNodeFinder->findFirst($booleanAnd->left, function (Node $node) : bool {
                return $this->nodeTypeResolver->getType($node) instanceof ObjectType;
            });
        }
        return \true;
    }
}
