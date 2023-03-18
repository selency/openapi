<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Configurator\ExampleConfigurator;
use Selency\OpenApi\Model\Example;

class ExampleConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testBuildEmpty(): void
    {
        $configurator = new ExampleConfigurator();

        $example = $configurator->build();
        $this->assertInstanceOf(Example::class, $example);
        $this->assertNull($example->getValue());
        $this->assertNull($example->getExternalValue());
        $this->assertNull($example->getDescription());
        $this->assertNull($example->getSummary());
        $this->assertSame([], $example->getSpecificationExtensions());
    }

    public function testBuildFull(): void
    {
        $configurator = (new ExampleConfigurator())
            ->value('value')
            ->externalValue('external value')
            ->description('description')
            ->summary('summary')
            ->specificationExtension('x-ext', 'value')
        ;

        $example = $configurator->build();
        $this->assertInstanceOf(Example::class, $example);
        $this->assertSame('value', $example->getValue());
        $this->assertSame('external value', $example->getExternalValue());
        $this->assertSame('description', $example->getDescription());
        $this->assertSame('summary', $example->getSummary());
        $this->assertSame(['x-ext' => 'value'], $example->getSpecificationExtensions());
    }
}
