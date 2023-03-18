<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\MediaTypeConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Configurator\SchemaConfigurator;
use Selency\OpenApi\Model\MediaType;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ContentTrait
{
    /**
     * @var array<string, MediaType>
     */
    private array $content = [];

    public function content(string $contentType, MediaTypeConfigurator|SchemaConfigurator|ReferenceConfigurator|string $mediaType): static
    {
        if (!$mediaType instanceof MediaTypeConfigurator) {
            $mediaType = (new MediaTypeConfigurator())->schema($mediaType);
        }

        $this->content[$contentType] = $mediaType->build();

        return $this;
    }
}
