<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Configurator\EncodingConfigurator;
use Selency\OpenApi\Configurator\ExampleConfigurator;
use Selency\OpenApi\Configurator\MediaTypeConfigurator;
use Selency\OpenApi\Configurator\SchemaConfigurator;
use Selency\OpenApi\Model\Encoding;
use Selency\OpenApi\Model\Example;
use Selency\OpenApi\Model\MediaType;
use Selency\OpenApi\Model\Schema;

class MediaTypeConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testBuildEmpty(): void
    {
        $configurator = new MediaTypeConfigurator();

        $mediaType = $configurator->build();
        $this->assertInstanceOf(MediaType::class, $mediaType);
        $this->assertNull($mediaType->getSchema());
        $this->assertNull($mediaType->getExample());
        $this->assertNull($mediaType->getExamples());
        $this->assertNull($mediaType->getEncodings());
        $this->assertSame([], $mediaType->getSpecificationExtensions());
    }

    public function testBuildFull(): void
    {
        [$schemaConfigurator, $schema] = $this->createConfiguratorMock(SchemaConfigurator::class, Schema::class);
        [$exampleConfigurator, $example] = $this->createConfiguratorMock(ExampleConfigurator::class, Example::class);
        [$encodingConfigurator, $encoding] = $this->createConfiguratorMock(EncodingConfigurator::class, Encoding::class);

        $configurator = (new MediaTypeConfigurator())
            ->schema($schemaConfigurator)
            ->example('example')
            ->example('ExampleName', $exampleConfigurator)
            ->encoding('EncodingName', $encodingConfigurator)
            ->specificationExtension('x-ext', 'value')
        ;

        $mediaType = $configurator->build();
        $this->assertInstanceOf(MediaType::class, $mediaType);
        $this->assertSame($schema, $mediaType->getSchema());
        $this->assertSame('example', $mediaType->getExample());
        $this->assertSame($example, $mediaType->getExamples()['ExampleName']);
        $this->assertSame($encoding, $mediaType->getEncodings()['EncodingName']);
        $this->assertSame(['x-ext' => 'value'], $mediaType->getSpecificationExtensions());
    }
}
