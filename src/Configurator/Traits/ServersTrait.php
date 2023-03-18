<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\ServerConfigurator;
use Selency\OpenApi\Model\Server;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ServersTrait
{
    /**
     * @var Server[]
     */
    private array $servers = [];

    public function server(ServerConfigurator|string $server): static
    {
        $this->servers[] = \is_string($server) ? (new ServerConfigurator($server))->build() : $server->build();

        return $this;
    }
}
