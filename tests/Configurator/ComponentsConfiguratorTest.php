<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Configurator\CallbackRequestConfigurator;
use Selency\OpenApi\Configurator\ComponentsConfigurator;
use Selency\OpenApi\Configurator\ExampleConfigurator;
use Selency\OpenApi\Configurator\LinkConfigurator;
use Selency\OpenApi\Configurator\ParameterConfigurator;
use Selency\OpenApi\Configurator\PathItemConfigurator;
use Selency\OpenApi\Configurator\RequestBodyConfigurator;
use Selency\OpenApi\Configurator\ResponseConfigurator;
use Selency\OpenApi\Configurator\SchemaConfigurator;
use Selency\OpenApi\Configurator\SecuritySchemeConfigurator;
use Selency\OpenApi\Model\CallbackRequest;
use Selency\OpenApi\Model\Components;
use Selency\OpenApi\Model\Example;
use Selency\OpenApi\Model\Link;
use Selency\OpenApi\Model\Parameter;
use Selency\OpenApi\Model\PathItem;
use Selency\OpenApi\Model\RequestBody;
use Selency\OpenApi\Model\Response;
use Selency\OpenApi\Model\Schema;
use Selency\OpenApi\Model\SecurityScheme;

class ComponentsConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testBuildEmpty(): void
    {
        $components = (new ComponentsConfigurator())->build();
        $this->assertInstanceOf(Components::class, $components);
        $this->assertNull($components->getSchemas());
        $this->assertNull($components->getResponses());
        $this->assertNull($components->getParameters());
        $this->assertNull($components->getExamples());
        $this->assertNull($components->getRequestBodies());
        $this->assertNull($components->getSecuritySchemes());
        $this->assertNull($components->getLinks());
        $this->assertNull($components->getCallbacks());
        $this->assertNull($components->getPathItems());
        $this->assertSame([], $components->getSpecificationExtensions());
    }

    public function testBuildFull(): void
    {
        [$schemaConfigurator, $schema] = $this->createConfiguratorMock(SchemaConfigurator::class, Schema::class);
        [$responseConfigurator, $response] = $this->createConfiguratorMock(ResponseConfigurator::class, Response::class);
        [$parameterConfigurator, $parameter] = $this->createConfiguratorMock(ParameterConfigurator::class, Parameter::class);
        [$exampleConfigurator, $example] = $this->createConfiguratorMock(ExampleConfigurator::class, Example::class);
        [$requestBodyConfigurator, $requestBody] = $this->createConfiguratorMock(RequestBodyConfigurator::class, RequestBody::class);
        [$securitySchemeConfigurator, $securityScheme] = $this->createConfiguratorMock(SecuritySchemeConfigurator::class, SecurityScheme::class);
        [$linkConfigurator, $link] = $this->createConfiguratorMock(LinkConfigurator::class, Link::class);
        [$callbackRequestConfigurator, $callbackRequest] = $this->createConfiguratorMock(CallbackRequestConfigurator::class, CallbackRequest::class);
        [$pathItemConfigurator, $pathItem] = $this->createConfiguratorMock(PathItemConfigurator::class, PathItem::class);

        $configurator = (new ComponentsConfigurator())
            ->schema('SchemaName', $schemaConfigurator)
            ->response('ResponseName', $responseConfigurator)
            ->parameter('ParameterName', $parameterConfigurator)
            ->example('ExampleName', $exampleConfigurator)
            ->requestBody('RequestBodyName', $requestBodyConfigurator)
            ->securityScheme('SecuritySchemeName', $securitySchemeConfigurator)
            ->link('LinkName', $linkConfigurator)
            ->callback('CallbackRequestName', $callbackRequestConfigurator)
            ->pathItem('PathItemName', $pathItemConfigurator)
            ->specificationExtension('x-ext', 'value')
        ;

        $components = $configurator->build();
        $this->assertInstanceOf(Components::class, $components);
        $this->assertSame($schema, $components->getSchemas()['SchemaName']);
        $this->assertSame($response, $components->getResponses()['ResponseName']);
        $this->assertSame($parameter, $components->getParameters()['ParameterName']);
        $this->assertSame($example, $components->getExamples()['ExampleName']);
        $this->assertSame($requestBody, $components->getRequestBodies()['RequestBodyName']);
        $this->assertSame($securityScheme, $components->getSecuritySchemes()['SecuritySchemeName']);
        $this->assertSame($link, $components->getLinks()['LinkName']);
        $this->assertSame($callbackRequest, $components->getCallbacks()['CallbackRequestName']);
        $this->assertSame($pathItem, $components->getPathItems()['PathItemName']);
        $this->assertSame(['x-ext' => 'value'], $components->getSpecificationExtensions());
    }
}
