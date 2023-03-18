<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\LinkConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Model\Link;
use Selency\OpenApi\Model\Reference;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait LinksTrait
{
    /**
     * @var array<string, Link|Reference>
     */
    private array $links = [];

    public function link(string $name, LinkConfigurator|ReferenceConfigurator|string $link): static
    {
        if (\is_string($link)) {
            $link = new ReferenceConfigurator('#/components/links/'.ReferenceConfigurator::normalize($link));
        }

        $this->links[$name] = $link->build();

        return $this;
    }
}
