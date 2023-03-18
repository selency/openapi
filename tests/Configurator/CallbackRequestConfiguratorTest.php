<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Configurator\CallbackRequestConfigurator;
use Selency\OpenApi\Configurator\PathItemConfigurator;
use Selency\OpenApi\Model\CallbackRequest;
use Selency\OpenApi\Model\PathItem;

class CallbackRequestConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testBuildEmpty(): void
    {
        $configurator = new CallbackRequestConfigurator();

        $callback = $configurator->build();
        $this->assertInstanceOf(CallbackRequest::class, $callback);
        $this->assertSame('', $callback->getExpression());
        $this->assertNull($callback->getDefinition());
        $this->assertSame([], $callback->getSpecificationExtensions());
    }

    public function testBuildFull(): void
    {
        [$pathItemConfigurator, $pathItem] = $this->createConfiguratorMock(PathItemConfigurator::class, PathItem::class);

        $configurator = (new CallbackRequestConfigurator())
            ->expression('{$request.query.queryUrl}')
            ->definition($pathItemConfigurator)
            ->specificationExtension('x-ext', 'value')
        ;

        $callback = $configurator->build();
        $this->assertInstanceOf(CallbackRequest::class, $callback);
        $this->assertSame('{$request.query.queryUrl}', $callback->getExpression());
        $this->assertSame($pathItem, $callback->getDefinition());
        $this->assertSame(['x-ext' => 'value'], $callback->getSpecificationExtensions());
    }
}
