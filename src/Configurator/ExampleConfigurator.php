<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Example;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class ExampleConfigurator
{
    use Traits\DescriptionTrait;
    use Traits\ExtensionsTrait;
    use Traits\SummaryTrait;

    private mixed $value = null;
    private ?string $externalValue = null;

    public function build(): Example
    {
        return new Example(
            $this->summary,
            $this->description,
            $this->value,
            $this->externalValue,
            $this->specificationExtensions,
        );
    }

    public function value(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function externalValue(string $externalValue): static
    {
        $this->externalValue = $externalValue;

        return $this;
    }
}
