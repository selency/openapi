<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Tests\Configurator\fixtures;

use Selency\OpenApi\Builder\OpenApiBuilderInterface;
use Selency\OpenApi\Configurator\QueryParametersConfigurator;

class ClassWithQueryParameterDescribeMethod
{
    public static function describeQueryParameters(QueryParametersConfigurator $configurator, OpenApiBuilderInterface $openApi): void
    {
        $configurator
            ->queryParameter($openApi->queryParameter('test'))
        ;
    }
}
