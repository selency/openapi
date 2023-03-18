<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Link;
use Selency\OpenApi\Model\Server;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class LinkConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\DescriptionTrait;
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;
    use \Selency\OpenApi\Configurator\Traits\ParametersTrait;

    private ?string $operationRef = null;
    private ?string $operationId = null;
    private mixed $requestBody = null;
    private ?Server $server = null;

    public function build(): Link
    {
        return new Link(
            $this->operationRef,
            $this->operationId,
            $this->parameters ?: null,
            $this->requestBody,
            $this->description,
            $this->server,
            $this->specificationExtensions,
        );
    }

    public function operationRef(?string $operationRef): static
    {
        $this->operationRef = $operationRef;

        return $this;
    }

    public function operationId(?string $operationId): static
    {
        $this->operationId = $operationId;

        return $this;
    }

    public function requestBody(mixed $requestBody): static
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function server(ServerConfigurator|string $server): static
    {
        $this->server = \is_string($server) ? (new ServerConfigurator($server))->build() : $server->build();

        return $this;
    }
}
