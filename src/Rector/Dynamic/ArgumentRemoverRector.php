<?php declare(strict_types=1);

namespace Rector\Rector\Dynamic;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Configuration\Rector\ArgumentRemoverRecipe;
use Rector\Configuration\Rector\ArgumentRemoverRecipeFactory;
use Rector\NodeAnalyzer\ClassMethodAnalyzer;
use Rector\NodeAnalyzer\MethodCallAnalyzer;
use Rector\NodeAnalyzer\StaticMethodCallAnalyzer;
use Rector\RectorDefinition\CodeSample;
use Rector\RectorDefinition\RectorDefinition;

final class ArgumentRemoverRector extends AbstractArgumentRector
{
    /**
     * @var ArgumentRemoverRecipe[]
     */
    private $argumentRemoverRecipes = [];

    /**
     * @var ArgumentRemoverRecipe[]
     */
    private $activeArgumentRemoverRecipes = [];

    /**
     * @var ArgumentRemoverRecipeFactory
     */
    private $argumentRemoverRecipeFactory;

    /**
     * @param mixed[] $argumentChangesByMethodAndType
     */
    public function __construct(
        array $argumentChangesByMethodAndType,
        MethodCallAnalyzer $methodCallAnalyzer,
        ClassMethodAnalyzer $classMethodAnalyzer,
        StaticMethodCallAnalyzer $staticMethodCallAnalyzer,
        ArgumentRemoverRecipeFactory $argumentRemoverRecipeFactory
    ) {
        parent::__construct($methodCallAnalyzer, $classMethodAnalyzer, $staticMethodCallAnalyzer);
        $this->argumentRemoverRecipeFactory = $argumentRemoverRecipeFactory;
        $this->loadArgumentReplacerRecipes($argumentChangesByMethodAndType);
    }

    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition(
            '[Dynamic] Removes defined arguments in defined methods and their calls.',
            [
                new CodeSample(
                    '$containerBuilder = new Symfony\Component\DependencyInjection\ContainerBuilder;
$containerBuilder->compile(true);',
                    '$containerBuilder = new Symfony\Component\DependencyInjection\ContainerBuilder;
$containerBuilder->compile();'
                ),
            ]
        );
    }

    public function isCandidate(Node $node): bool
    {
        if (! $this->isValidInstance($node)) {
            return false;
        }

        $this->activeArgumentRemoverRecipes = $this->matchArgumentChanges($node);

        return (bool) $this->activeArgumentRemoverRecipes;
    }

    /**
     * @param MethodCall|StaticCall|ClassMethod $node
     */
    public function refactor(Node $node): Node
    {
        $argumentsOrParameters = $this->getNodeArgumentsOrParameters($node);
        $argumentsOrParameters = $this->processArgumentNodes($argumentsOrParameters);

        $this->setNodeArgumentsOrParameters($node, $argumentsOrParameters);

        return $node;
    }

    /**
     * @return ArgumentRemoverRecipe[]
     */
    private function matchArgumentChanges(Node $node): array
    {
        $argumentReplacerRecipes = [];

        foreach ($this->argumentRemoverRecipes as $argumentRemoverRecipe) {
            if ($this->isNodeToRecipeMatch($node, $argumentRemoverRecipe)) {
                $argumentReplacerRecipes[] = $argumentRemoverRecipe;
            }
        }

        return $argumentReplacerRecipes;
    }

    /**
     * @param mixed[] $configurationArrays
     */
    private function loadArgumentReplacerRecipes(array $configurationArrays): void
    {
        foreach ($configurationArrays as $configurationArray) {
            $this->argumentRemoverRecipes[] = $this->argumentRemoverRecipeFactory->createFromArray(
                $configurationArray
            );
        }
    }

    /**
     * @param mixed[] $argumentNodes
     * @return mixed[]
     */
    private function processArgumentNodes(array $argumentNodes): array
    {
        foreach ($this->activeArgumentRemoverRecipes as $activeArgumentRemoverRecipe) {
            $position = $activeArgumentRemoverRecipe->getPosition();
            unset($argumentNodes[$position]);
        }

        return $argumentNodes;
    }
}
