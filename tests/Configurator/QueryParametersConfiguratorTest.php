<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Builder\OpenApiBuilder;
use Selency\OpenApi\Configurator\QueryParametersConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Model\Parameter;
use Selency\OpenApi\Model\ParameterIn;
use Selency\OpenApi\Tests\Configurator\fixtures\ClassWithoutQueryParameterDescribeMethod;
use Selency\OpenApi\Tests\Configurator\fixtures\ClassWithQueryParameterDescribeMethod;

class QueryParametersConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testEmpty(): void
    {
        $configurator = new QueryParametersConfigurator(new OpenApiBuilder());

        $this->assertEmpty($configurator->getParameters());
    }

    public function testAddQueryParameters(): void
    {
        $configurator = new QueryParametersConfigurator(new OpenApiBuilder());

        $configurator
            ->queryParameter('test1')
            ->queryParameter('test2')
        ;

        $parameters = $configurator->getParameters();

        $this->assertCount(2, $parameters);
        $this->assertSame('#/components/parameters/test1', $parameters[0]->getRef());
        $this->assertSame('#/components/parameters/test2', $parameters[1]->getRef());
    }

    public function testFromDefinitionEmpty(): void
    {
        $configurator = QueryParametersConfigurator::createFromDefinition('', new OpenApiBuilder());

        $this->assertInstanceOf(QueryParametersConfigurator::class, $configurator);
        $this->assertEmpty($configurator->getParameters());
    }

    public function testFromDefinitionQueryParameter(): void
    {
        $definition = new QueryParametersConfigurator(new OpenApiBuilder());
        $configurator = QueryParametersConfigurator::createFromDefinition($definition, new OpenApiBuilder());

        $this->assertSame($configurator, $definition);
    }

    public function testFromDefinitionReference(): void
    {
        $definition = new ReferenceConfigurator('test');
        $configurator = QueryParametersConfigurator::createFromDefinition($definition, new OpenApiBuilder());

        $this->assertSame($configurator, $definition);
    }

    public function testFromDefinitionClassWithoutDescribe(): void
    {
        /** @var ReferenceConfigurator $configurator */
        $configurator = QueryParametersConfigurator::createFromDefinition(ClassWithoutQueryParameterDescribeMethod::class, new OpenApiBuilder());

        $this->assertInstanceOf(ReferenceConfigurator::class, $configurator);
        $this->assertSame(
            '#/components/parameters/Selency_OpenApi_Tests_Configurator_fixtures_ClassWithoutQueryParameterDescribeMethod',
            $configurator->build()->getRef()
        );
    }

    public function testFromDefinitionClassWithDescribe(): void
    {
        /** @var QueryParametersConfigurator $configurator */
        $configurator = QueryParametersConfigurator::createFromDefinition(ClassWithQueryParameterDescribeMethod::class, new OpenApiBuilder());

        $this->assertInstanceOf(QueryParametersConfigurator::class, $configurator);

        $parameters = $configurator->getParameters();

        $this->assertCount(1, $parameters);

        /** @var Parameter $parameter */
        $parameter = $parameters[0];

        $this->assertInstanceOf(Parameter::class, $parameter);
        $this->assertSame('test', $parameter->getName());
        $this->assertSame(ParameterIn::QUERY, $parameter->getIn());
    }
}
