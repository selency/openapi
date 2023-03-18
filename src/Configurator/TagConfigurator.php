<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Tag;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class TagConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\DescriptionTrait;
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;
    use \Selency\OpenApi\Configurator\Traits\ExternalDocsTrait;
    use \Selency\OpenApi\Configurator\Traits\NameTrait;

    public function build(): Tag
    {
        return new Tag($this->name ?: '', $this->description, $this->externalDocs, $this->specificationExtensions);
    }
}
