<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Loader;

use Selency\OpenApi\Builder\OpenApiBuilderInterface;
use Selency\OpenApi\Configurator\ComponentsConfigurator;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class SelfDescribingSchemaLoader implements ComponentsLoaderInterface
{
    /**
     * @param iterable<class-string<SelfDescribingSchemaInterface>> $selfDescribingSchemas
     */
    public function __construct(private iterable $selfDescribingSchemas = [])
    {
    }

    public function load(OpenApiBuilderInterface $openApi): ComponentsConfigurator
    {
        $components = $openApi->components();

        foreach ($this->selfDescribingSchemas as $selfDescribingSchema) {
            $configurator = $openApi->schema()->type('object');
            \call_user_func([$selfDescribingSchema, 'describeSchema'], $configurator, $openApi);

            $components->schema($selfDescribingSchema, $configurator);
        }

        return $components;
    }
}
