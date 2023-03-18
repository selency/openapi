<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Builder\OpenApiBuilderInterface;
use Selency\OpenApi\Configurator\QueryParameterConfigurator;
use Selency\OpenApi\Configurator\QueryParametersConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Model\Parameter;
use Selency\OpenApi\Model\Reference;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait QueryParametersTrait
{
    /**
     * @var array<Parameter|Reference>
     */
    private array $queryParameters = [];
    private ?OpenApiBuilderInterface $openApiBuilder = null;

    public function queryParameter(QueryParameterConfigurator|ReferenceConfigurator|string $parameter): static
    {
        if (\is_string($parameter)) {
            $parameter = new ReferenceConfigurator('#/components/parameters/'.ReferenceConfigurator::normalize($parameter));
        }

        $this->queryParameters[] = $parameter->build();

        return $this;
    }

    public function queryParameters(QueryParametersConfigurator|string $parameters): static
    {
        $configurator = QueryParametersConfigurator::createFromDefinition($parameters, $this->openApiBuilder);

        if ($configurator instanceof ReferenceConfigurator) {
            $this->queryParameters[] = $configurator->build();

            return $this;
        }

        $this->queryParameters = array_merge($this->queryParameters, $configurator->getParameters());

        return $this;
    }
}
