<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Components;
use Selency\OpenApi\Model\OpenApi;
use Selency\OpenApi\Model\PathItem;
use Selency\OpenApi\Model\SecurityRequirement;
use Selency\OpenApi\Model\Tag;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class DocumentationConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;
    use \Selency\OpenApi\Configurator\Traits\ExternalDocsTrait;
    use \Selency\OpenApi\Configurator\Traits\ServersTrait;

    private string $version = '3.1.0';
    private ?string $jsonSchemaDialect = null;
    private ?InfoConfigurator $info = null;
    private ?Components $components = null;

    /**
     * @var Tag[]
     */
    private array $tags = [];

    /**
     * @var array<string, PathItem>
     */
    private array $paths = [];

    /**
     * @var array<string, PathItem>
     */
    private array $webhooks = [];

    /**
     * @var SecurityRequirement[]
     */
    private array $securityRequirements = [];

    public function build(string $identifier = '', string $version = ''): OpenApi
    {
        return new OpenApi(
            version: $this->version,
            info: ($this->info ?: new InfoConfigurator())->build($identifier, $version),
            servers: $this->servers ?: null,
            paths: $this->paths ?: null,
            webhooks: $this->webhooks ?: null,
            components: $this->components,
            security: $this->securityRequirements,
            tags: $this->tags ?: null,
            externalDocs: $this->externalDocs,
            jsonSchemaDialect: $this->jsonSchemaDialect,
            specificationExtensions: $this->specificationExtensions,
        );
    }

    public function version(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function jsonSchemaDialect(string $jsonSchemaDialect): static
    {
        $this->jsonSchemaDialect = $jsonSchemaDialect;

        return $this;
    }

    public function info(InfoConfigurator $info): static
    {
        $this->info = $info;

        return $this;
    }

    public function components(ComponentsConfigurator $components): static
    {
        $this->components = $components->build($this->components);

        return $this;
    }

    public function tag(TagConfigurator|string $tag): static
    {
        $this->tags[] = \is_string($tag) ? new Tag($tag) : $tag->build();

        return $this;
    }

    public function path(string $path, PathItemConfigurator|ReferenceConfigurator $pathItem): static
    {
        $this->paths[$path] = $pathItem->build($this->paths[$path] ?? null);

        return $this;
    }

    public function webhook(string $name, PathItemConfigurator|ReferenceConfigurator $pathItem): static
    {
        $this->webhooks[$name] = $pathItem->build();

        return $this;
    }

    public function securityRequirement(string $name, array $config = []): static
    {
        $this->securityRequirements[] = new SecurityRequirement($name, $config);

        return $this;
    }
}
