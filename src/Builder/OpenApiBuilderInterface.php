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
interface OpenApiBuilderInterface
{
    public function schema(SchemaConfigurator|ReferenceConfigurator|string $definition = null): SchemaConfigurator|ReferenceConfigurator;

    public function callbackRequest(): CallbackRequestConfigurator;

    public function components(): ComponentsConfigurator;

    public function content(): MediaTypeConfigurator;

    public function encoding(): EncodingConfigurator;

    public function example(): ExampleConfigurator;

    public function info(): InfoConfigurator;

    public function link(): LinkConfigurator;

    public function mediaType(): MediaTypeConfigurator;

    public function operation(): OperationConfigurator;

    public function parameter(string $name): ParameterConfigurator;

    public function queryParameter(string $name): QueryParameterConfigurator;

    public function queryParameters(): QueryParametersConfigurator;

    public function pathItem(): PathItemConfigurator;

    public function reference(string $ref): ReferenceConfigurator;

    public function requestBody(): RequestBodyConfigurator;

    public function response(): ResponseConfigurator;

    public function responses(): ResponsesConfigurator;

    public function securityScheme(): SecuritySchemeConfigurator;

    public function server(string $url): ServerConfigurator;

    public function tag(): TagConfigurator;
}
