<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Model\ExternalDocumentation;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ExternalDocsTrait
{
    private ?ExternalDocumentation $externalDocs = null;

    public function externalDocs(string $url, string $description = null, array $specificationExtensions = []): static
    {
        $this->externalDocs = new ExternalDocumentation($url, $description, $specificationExtensions);

        return $this;
    }
}
