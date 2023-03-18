<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Parameter;
use Selency\OpenApi\Model\ParameterIn;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class QueryParameterConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\ContentTrait;
    use \Selency\OpenApi\Configurator\Traits\DeprecatedTrait;
    use \Selency\OpenApi\Configurator\Traits\DescriptionTrait;
    use \Selency\OpenApi\Configurator\Traits\ExamplesTrait;
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;
    use \Selency\OpenApi\Configurator\Traits\NameTrait;
    use \Selency\OpenApi\Configurator\Traits\SchemaTrait;

    private ?bool $required = null;
    private ?bool $allowEmptyValue = null;
    private ?string $style = null;
    private ?bool $explode = null;
    private ?bool $allowReserved = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function build(): Parameter
    {
        return new Parameter(
            $this->name,
            ParameterIn::QUERY,
            $this->description,
            $this->required,
            $this->deprecated,
            $this->allowEmptyValue,
            $this->style,
            $this->explode,
            $this->allowReserved,
            $this->schema,
            $this->example,
            $this->examples,
            $this->content ?: null,
            $this->specificationExtensions,
        );
    }

    public function required(bool $required): static
    {
        $this->required = $required;

        return $this;
    }

    public function allowEmptyValue(bool $allowEmptyValue): static
    {
        $this->allowEmptyValue = $allowEmptyValue;

        return $this;
    }

    public function style(string $style): static
    {
        $this->style = $style;

        return $this;
    }

    public function explode(bool $explode): static
    {
        $this->explode = $explode;

        return $this;
    }

    public function allowReserved(bool $allowReserved): static
    {
        $this->allowReserved = $allowReserved;

        return $this;
    }
}
