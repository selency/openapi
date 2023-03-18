<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Compiler;

use Selency\OpenApi\Configurator\DocumentationConfigurator;
use Selency\OpenApi\Documentation\DocumentationInterface;
use Selency\OpenApi\Loader\ComponentsLoaderInterface;
use Selency\OpenApi\Model\OpenApi;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class DocumentationCompiler implements DocumentationCompilerInterface
{
    /**
     * @param iterable<ComponentsLoaderInterface> $componentsLoaders
     */
    public function __construct(private iterable $componentsLoaders = [])
    {
    }

    public function compile(DocumentationInterface $doc): OpenApi
    {
        // Instanciate root configurator
        $rootConfigurator = new DocumentationConfigurator();

        // Load components for this doc
        foreach ($this->componentsLoaders as $loader) {
            $doc->loadComponents($rootConfigurator, $loader);
        }

        // Apply user documentation details
        $doc->configure($rootConfigurator);

        // Compile the documentation
        return $rootConfigurator->build($doc->getIdentifier(), $doc->getVersion());
    }
}
