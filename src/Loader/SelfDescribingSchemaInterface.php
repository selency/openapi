<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Loader;

use Selency\OpenApi\Builder\OpenApiBuilderInterface;
use Selency\OpenApi\Configurator\SchemaConfigurator;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
interface SelfDescribingSchemaInterface
{
    public static function describeSchema(SchemaConfigurator $schema, OpenApiBuilderInterface $openApi): void;
}
