<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Model;

use Selency\OpenApi\Configurator\InfoConfigurator;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class OpenApi implements OpenApiModel
{
    use OpenApiTrait;

    /**
     * @param Server[]|null                          $servers
     * @param array<string, PathItem|Reference>|null $paths
     * @param array<string, PathItem|Reference>|null $webhooks
     * @param SecurityRequirement[]|null             $security
     * @param Tag[]|null                             $tags
     */
    public function __construct(
        private readonly string $version,
        private readonly Info $info,
        private readonly ?array $servers = null,
        private readonly ?array $paths = null,
        private readonly ?array $webhooks = null,
        private readonly ?Components $components = null,
        private readonly ?array $security = null,
        private readonly ?array $tags = null,
        private readonly ?ExternalDocumentation $externalDocs = null,
        private readonly ?string $jsonSchemaDialect = null,
        private readonly array $specificationExtensions = [],
    ) {
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getInfo(): Info
    {
        return $this->info;
    }

    /**
     * @return Server[]|null
     */
    public function getServers(): ?array
    {
        return $this->servers;
    }

    /**
     * @return array<string, PathItem|Reference>|null
     */
    public function getPaths(): ?array
    {
        return $this->paths;
    }

    /**
     * @return array<string, PathItem|Reference>|null
     */
    public function getWebhooks(): ?array
    {
        return $this->webhooks;
    }

    public function getComponents(): ?Components
    {
        return $this->components;
    }

    /**
     * @return SecurityRequirement[]|null
     */
    public function getSecurity(): ?array
    {
        return $this->security;
    }

    /**
     * @return Tag[]|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function getExternalDocs(): ?ExternalDocumentation
    {
        return $this->externalDocs;
    }

    public function getJsonSchemaDialect(): ?string
    {
        return $this->jsonSchemaDialect;
    }

    public function getSpecificationExtensions(): array
    {
        return $this->specificationExtensions;
    }

    public function toArray(): array
    {
        $exported = array_filter([
            'openapi' => $this->version,
            'info' => $this->info->toArray() ?: (new InfoConfigurator())->build()->toArray(),
            'servers' => $this->normalizeCollection($this->servers),
            'paths' => $this->normalizeCollection($this->paths),
            'components' => $this->components->toArray(),
            'tags' => $this->normalizeCollection($this->tags),
            'externalDocs' => $this->externalDocs?->toArray(),
            'jsonSchemaDialect' => $this->jsonSchemaDialect,
            'webhooks' => $this->normalizeCollection($this->webhooks),
        ] + $this->getSpecificationExtensions());

        $exported += ['security' => $this->normalizeCollection($this->security)];

        return $exported;
    }
}
