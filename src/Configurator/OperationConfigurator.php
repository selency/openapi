<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Builder\OpenApiBuilderInterface;
use Selency\OpenApi\Model\CallbackRequest;
use Selency\OpenApi\Model\Operation;
use Selency\OpenApi\Model\Reference;
use Selency\OpenApi\Model\RequestBody;
use Selency\OpenApi\Model\Responses;
use Selency\OpenApi\Model\SecurityRequirement;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class OperationConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\DeprecatedTrait;
    use \Selency\OpenApi\Configurator\Traits\DescriptionTrait;
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;
    use \Selency\OpenApi\Configurator\Traits\ExternalDocsTrait;
    use \Selency\OpenApi\Configurator\Traits\ParametersTrait;
    use \Selency\OpenApi\Configurator\Traits\QueryParametersTrait;
    use \Selency\OpenApi\Configurator\Traits\ServersTrait;
    use \Selency\OpenApi\Configurator\Traits\SummaryTrait;

    private ?string $operationId = null;

    /**
     * @var string[]
     */
    private array $tags = [];

    private RequestBody|Reference|null $requestBody = null;
    private Responses|null $responses = null;

    /**
     * @var array<string, CallbackRequest|Reference>
     */
    private array $callbacks = [];

    /**
     * @var SecurityRequirement[]|null
     */
    private ?array $securityRequirements = null;

    public function __construct(OpenApiBuilderInterface $openApiBuilder)
    {
        $this->openApiBuilder = $openApiBuilder;
    }

    public function build(): Operation
    {
        return new Operation(
            operationId: $this->operationId,
            summary: $this->summary,
            description: $this->description,
            deprecated: $this->deprecated,
            tags: $this->tags ?: null,
            externalDocs: $this->externalDocs,
            parameters: array_merge($this->parameters, $this->queryParameters) ?: null,
            requestBody: $this->requestBody,
            responses: $this->responses,
            callbacks: $this->callbacks ?: null,
            security: $this->securityRequirements,
            servers: $this->servers ?: null,
            specificationExtensions: $this->specificationExtensions,
        );
    }

    public function operationId(string $operationId): static
    {
        $this->operationId = $operationId;

        return $this;
    }

    public function tag(string $tag): static
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function responses(ResponsesConfigurator $responses): static
    {
        $this->responses = $responses->build();

        return $this;
    }

    public function requestBody(RequestBodyConfigurator|ReferenceConfigurator|string $requestBody): static
    {
        if (\is_string($requestBody)) {
            $requestBody = new ReferenceConfigurator('#/components/requestBodies/'.ReferenceConfigurator::normalize($requestBody));
        }

        $this->requestBody = $requestBody->build();

        return $this;
    }

    public function callback(string $name, CallbackRequestConfigurator|ReferenceConfigurator|string $callbackRequest): static
    {
        if (\is_string($callbackRequest)) {
            $callbackRequest = new ReferenceConfigurator('#/components/callbacks/'.ReferenceConfigurator::normalize($callbackRequest));
        }

        $this->callbacks[$name] = $callbackRequest->build();

        return $this;
    }

    public function securityRequirement(?string $name, array $config = []): static
    {
        // Allow not having security
        if (null === $name) {
            $this->securityRequirements[] = new SecurityRequirement(SecurityRequirement::NONE, []);

            return $this;
        }

        $this->securityRequirements[] = new SecurityRequirement($name, $config);

        return $this;
    }
}
