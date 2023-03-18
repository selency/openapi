<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Documentation;

use Selency\OpenApi\Configurator\DocumentationConfigurator;
use Selency\OpenApi\Loader\ComponentsLoaderInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
interface DocumentationInterface
{
    public function getIdentifier(): string;

    public function getVersion(): string;

    public function configure(DocumentationConfigurator $doc): void;

    public function loadComponents(DocumentationConfigurator $doc, ComponentsLoaderInterface $loader): void;
}
