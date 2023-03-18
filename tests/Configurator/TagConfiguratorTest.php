<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator;

use Selency\OpenApi\Configurator\TagConfigurator;
use Selency\OpenApi\Model\ExternalDocumentation;
use Selency\OpenApi\Model\Tag;

class TagConfiguratorTest extends AbstractConfiguratorTestCase
{
    public function testBuildEmpty(): void
    {
        $configurator = new TagConfigurator();

        $tag = $configurator->build();
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertSame('', $tag->getName());
        $this->assertNull($tag->getDescription());
        $this->assertNull($tag->getExternalDocs());
        $this->assertSame([], $tag->getSpecificationExtensions());
    }

    public function testBuildFull(): void
    {
        $configurator = (new TagConfigurator())
            ->name('name')
            ->description('description')
            ->externalDocs(url: 'https://example.com', description: 'external docs', specificationExtensions: ['x-ext2' => 'value'])
            ->specificationExtension('x-ext', 'value')
        ;

        $tag = $configurator->build();
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertSame('name', $tag->getName());
        $this->assertSame('description', $tag->getDescription());
        $this->assertSame(['x-ext' => 'value'], $tag->getSpecificationExtensions());
        $this->assertInstanceOf(ExternalDocumentation::class, $tag->getExternalDocs());
        $this->assertSame('https://example.com', $tag->getExternalDocs()->getUrl());
        $this->assertSame('external docs', $tag->getExternalDocs()->getDescription());
        $this->assertSame(['x-ext2' => 'value'], $tag->getExternalDocs()->getSpecificationExtensions());
    }
}
