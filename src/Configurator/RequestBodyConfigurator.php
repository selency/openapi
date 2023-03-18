<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\RequestBody;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class RequestBodyConfigurator
{
    use \Selency\OpenApi\Configurator\Traits\ContentTrait;
    use \Selency\OpenApi\Configurator\Traits\DescriptionTrait;
    use \Selency\OpenApi\Configurator\Traits\ExtensionsTrait;

    private ?bool $required = null;

    public function build(): RequestBody
    {
        return new RequestBody($this->content, $this->description, $this->required, $this->specificationExtensions);
    }

    public function required(bool $required): static
    {
        $this->required = $required;

        return $this;
    }
}
