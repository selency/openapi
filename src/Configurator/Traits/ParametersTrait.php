<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\ParameterConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Model\Parameter;
use Selency\OpenApi\Model\Reference;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ParametersTrait
{
    /**
     * @var array<Parameter|Reference>
     */
    private array $parameters = [];

    public function parameter(ParameterConfigurator|ReferenceConfigurator|string $parameter): static
    {
        if (\is_string($parameter)) {
            $parameter = new ReferenceConfigurator('#/components/parameters/'.ReferenceConfigurator::normalize($parameter));
        }

        $this->parameters[] = $parameter->build();

        return $this;
    }
}
