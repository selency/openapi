<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Configurator\SchemaConfigurator;
use Selency\OpenApi\Model\Reference;
use Selency\OpenApi\Model\Schema;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait SchemaTrait
{
    private Schema|Reference|null $schema = null;

    public function schema(SchemaConfigurator|ReferenceConfigurator|string $schema): static
    {
        $this->schema = SchemaConfigurator::createFromDefinition($schema)->build();

        return $this;
    }
}
