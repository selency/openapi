<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Response;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class ResponseConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\ContentTrait;
    use \Selency\OpenApi\Configurator\Traits\DescriptionTrait;
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;
    use \Selency\OpenApi\Configurator\Traits\HeadersTrait;
    use \Selency\OpenApi\Configurator\Traits\LinksTrait;

    public function build(): Response
    {
        return new Response(
            $this->description ?: '',
            $this->headers ?: null,
            $this->content ?: null,
            $this->links ?: null,
            $this->specificationExtensions,
        );
    }
}
