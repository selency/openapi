<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Configurator\ResponseConfigurator;
use Selency\OpenApi\Model\Reference;
use Selency\OpenApi\Model\Response;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ResponsesTrait
{
    /**
     * @var array<string, Response|Reference>
     */
    private array $responses = [];

    public function response(string $name, ResponseConfigurator|ReferenceConfigurator|string $response): static
    {
        if (\is_string($response)) {
            $response = new ReferenceConfigurator('#/components/responses/'.ReferenceConfigurator::normalize($response));
        }

        $this->responses[$name] = $response->build();

        return $this;
    }
}
