<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Loader;

use Selency\OpenApi\Builder\OpenApiBuilderInterface;
use Selency\OpenApi\Configurator\SchemaConfigurator;
use Selency\OpenApi\Loader\SelfDescribingSchemaInterface;

class MockSelfDescribingSchema implements SelfDescribingSchemaInterface
{
    public static function describeSchema(SchemaConfigurator $schema, OpenApiBuilderInterface $openApi): void
    {
        $schema
            ->title('Mock')
            ->property('username', 'string')
            ->property('status', $openApi->schema()->enum(['active', 'banned']))
        ;
    }
}
