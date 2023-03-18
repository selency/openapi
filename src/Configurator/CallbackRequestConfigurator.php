<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\CallbackRequest;
use Selency\OpenApi\Model\PathItem;
use Selency\OpenApi\Model\Reference;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class CallbackRequestConfigurator
{
    use Traits\ExtensionsTrait;

    private string $expression = '';
    private PathItem|Reference|null $definition = null;

    public function build(): CallbackRequest
    {
        return new CallbackRequest($this->expression, $this->definition, $this->specificationExtensions);
    }

    public function expression(string $expression): static
    {
        $this->expression = $expression;

        return $this;
    }

    public function definition(ReferenceConfigurator|PathItemConfigurator $definition): static
    {
        $this->definition = $definition->build();

        return $this;
    }
}
