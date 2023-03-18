<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Builder\OpenApiBuilder;
use Selency\OpenApi\Configurator\CallbackRequestConfigurator;
use Selency\OpenApi\Configurator\OperationConfigurator;
use Selency\OpenApi\Configurator\ParameterConfigurator;
use Selency\OpenApi\Configurator\RequestBodyConfigurator;
use Selency\OpenApi\Configurator\ResponsesConfigurator;
use Selency\OpenApi\Configurator\ServerConfigurator;
use Selency\OpenApi\Model\CallbackRequest;
use Selency\OpenApi\Model\Operation;
use Selency\OpenApi\Model\Parameter;
use Selency\OpenApi\Model\RequestBody;
use Selency\OpenApi\Model\Responses;
use Selency\OpenApi\Model\Server;

class OperationConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testBuildEmpty(): void
    {
        $configurator = new OperationConfigurator(new OpenApiBuilder());

        $operation = $configurator->build();
        $this->assertInstanceOf(Operation::class, $operation);
        $this->assertNull($operation->getOperationId());
        $this->assertNull($operation->getSummary());
        $this->assertNull($operation->getDescription());
        $this->assertNull($operation->getDeprecated());
        $this->assertNull($operation->getTags());
        $this->assertNull($operation->getExternalDocs());
        $this->assertNull($operation->getParameters());
        $this->assertNull($operation->getRequestBody());
        $this->assertNull($operation->getResponses());
        $this->assertNull($operation->getCallbacks());
        $this->assertNull($operation->getSecurity());
        $this->assertNull($operation->getServers());
        $this->assertSame([], $operation->getSpecificationExtensions());
    }

    public function testBuildFull(): void
    {
        [$parameterConfigurator, $parameter] = $this->createConfiguratorMock(ParameterConfigurator::class, Parameter::class);
        [$requestBodyConfigurator, $requestBody] = $this->createConfiguratorMock(RequestBodyConfigurator::class, RequestBody::class);
        [$responsesConfigurator, $responses] = $this->createConfiguratorMock(ResponsesConfigurator::class, Responses::class);
        [$callbackRequestConfigurator, $callbackRequest] = $this->createConfiguratorMock(CallbackRequestConfigurator::class, CallbackRequest::class);
        [$serverConfigurator, $server] = $this->createConfiguratorMock(ServerConfigurator::class, Server::class);

        $configurator = (new OperationConfigurator(new OpenApiBuilder()))
            ->operationId('operation_id')
            ->summary('summary')
            ->description('description')
            ->deprecated(true)
            ->tag('TagName')
            ->externalDocs('https://selency.fr', 'Description example', ['x-key' => 'value'])
            ->parameter($parameterConfigurator)
            ->requestBody($requestBodyConfigurator)
            ->responses($responsesConfigurator)
            ->callback('CallbackName', $callbackRequestConfigurator)
            ->securityRequirement('SecurityRequirement', ['config' => 'value'])
            ->server($serverConfigurator)
            ->specificationExtension('x-ext', 'value')
        ;

        $operation = $configurator->build();
        $this->assertInstanceOf(Operation::class, $operation);
        $this->assertSame('operation_id', $operation->getOperationId());
        $this->assertSame('summary', $operation->getSummary());
        $this->assertSame('description', $operation->getDescription());
        $this->assertTrue($operation->getDeprecated());
        $this->assertSame(['TagName'], $operation->getTags());
        $this->assertNotNull($operation->getExternalDocs());
        $this->assertSame('https://selency.fr', $operation->getExternalDocs()->getUrl());
        $this->assertSame('Description example', $operation->getExternalDocs()->getDescription());
        $this->assertSame(['x-key' => 'value'], $operation->getExternalDocs()->getSpecificationExtensions());
        $this->assertSame($parameter, $operation->getParameters()[0]);
        $this->assertSame($requestBody, $operation->getRequestBody());
        $this->assertSame($responses, $operation->getResponses());
        $this->assertSame($callbackRequest, $operation->getCallbacks()['CallbackName']);
        $this->assertSame('SecurityRequirement', $operation->getSecurity()[0]->getName());
        $this->assertSame(['config' => 'value'], $operation->getSecurity()[0]->getConfig());
        $this->assertSame($server, $operation->getServers()[0]);
        $this->assertSame(['x-ext' => 'value'], $operation->getSpecificationExtensions());
    }

    public function testSecurityRequirementUseGlobal(): void
    {
        $operation = (new OperationConfigurator(new OpenApiBuilder()))->build();
        $this->assertSame([], $operation->toArray());
    }

    public function testSecurityRequirementForceNone(): void
    {
        $operation = (new OperationConfigurator(new OpenApiBuilder()))
            ->securityRequirement(null)
            ->build();

        $this->assertSame(['security' => []], $operation->toArray());
    }

    public function testSecurityRequirementAllowNone(): void
    {
        $operation = (new OperationConfigurator(new OpenApiBuilder()))
            ->securityRequirement(null)
            ->securityRequirement('JWTBearer')
            ->build();

        $this->assertSame([
            'security' => [
                ['__NO_SECURITY' => []],
                ['JWTBearer' => []],
            ],
        ], $operation->toArray());
    }
}
