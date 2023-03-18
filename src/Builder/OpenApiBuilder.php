<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Builder;

use Selency\OpenApi\Configurator\CallbackRequestConfigurator;
use Selency\OpenApi\Configurator\ComponentsConfigurator;
use Selency\OpenApi\Configurator\EncodingConfigurator;
use Selency\OpenApi\Configurator\ExampleConfigurator;
use Selency\OpenApi\Configurator\InfoConfigurator;
use Selency\OpenApi\Configurator\LinkConfigurator;
use Selency\OpenApi\Configurator\MediaTypeConfigurator;
use Selency\OpenApi\Configurator\OperationConfigurator;
use Selency\OpenApi\Configurator\ParameterConfigurator;
use Selency\OpenApi\Configurator\PathItemConfigurator;
use Selency\OpenApi\Configurator\QueryParameterConfigurator;
use Selency\OpenApi\Configurator\QueryParametersConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Configurator\RequestBodyConfigurator;
use Selency\OpenApi\Configurator\ResponseConfigurator;
use Selency\OpenApi\Configurator\ResponsesConfigurator;
use Selency\OpenApi\Configurator\SchemaConfigurator;
use Selency\OpenApi\Configurator\SecuritySchemeConfigurator;
use Selency\OpenApi\Configurator\ServerConfigurator;
use Selency\OpenApi\Configurator\TagConfigurator;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class OpenApiBuilder implements OpenApiBuilderInterface
{
    public function schema(SchemaConfigurator|ReferenceConfigurator|string $definition = null): SchemaConfigurator|ReferenceConfigurator
    {
        return SchemaConfigurator::createFromDefinition($definition);
    }

    public function callbackRequest(): CallbackRequestConfigurator
    {
        return new CallbackRequestConfigurator();
    }

    public function components(): ComponentsConfigurator
    {
        return new ComponentsConfigurator();
    }

    public function content(): MediaTypeConfigurator
    {
        return new MediaTypeConfigurator();
    }

    public function encoding(): EncodingConfigurator
    {
        return new EncodingConfigurator();
    }

    public function example(): ExampleConfigurator
    {
        return new ExampleConfigurator();
    }

    public function info(): InfoConfigurator
    {
        return new InfoConfigurator();
    }

    public function link(): LinkConfigurator
    {
        return new LinkConfigurator();
    }

    public function mediaType(): MediaTypeConfigurator
    {
        return new MediaTypeConfigurator();
    }

    public function operation(): OperationConfigurator
    {
        return new OperationConfigurator($this);
    }

    public function parameter(string $name): ParameterConfigurator
    {
        return new ParameterConfigurator($name);
    }

    public function queryParameter(string $name): QueryParameterConfigurator
    {
        return new QueryParameterConfigurator($name);
    }

    public function queryParameters(): QueryParametersConfigurator
    {
        return new QueryParametersConfigurator($this);
    }

    public function pathItem(): PathItemConfigurator
    {
        return new PathItemConfigurator($this);
    }

    public function reference(string $ref): ReferenceConfigurator
    {
        return new ReferenceConfigurator($ref);
    }

    public function requestBody(): RequestBodyConfigurator
    {
        return new RequestBodyConfigurator();
    }

    public function response(): ResponseConfigurator
    {
        return new ResponseConfigurator();
    }

    public function responses(): ResponsesConfigurator
    {
        return new ResponsesConfigurator();
    }

    public function securityScheme(): SecuritySchemeConfigurator
    {
        return new SecuritySchemeConfigurator();
    }

    public function server(string $url): ServerConfigurator
    {
        return new ServerConfigurator($url);
    }

    public function tag(): TagConfigurator
    {
        return new TagConfigurator();
    }
}
