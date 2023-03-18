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
interface ComponentsLoaderInterface
{
    public function load(OpenApiBuilderInterface $openApi): ComponentsConfigurator;
}
