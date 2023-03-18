<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Configurator\ExampleConfigurator;
use Selency\OpenApi\Configurator\ReferenceConfigurator;
use Selency\OpenApi\Model\Example;
use Selency\OpenApi\Model\Reference;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ExamplesTrait
{
    private mixed $example = null;

    /**
     * @var array<string, Example|Reference>|null
     */
    private ?array $examples = null;

    public function example(mixed $name, ExampleConfigurator|ReferenceConfigurator $example = null): static
    {
        if ($example) {
            $this->examples[$name] = $example->build();
        } else {
            $this->example = $name;
        }

        return $this;
    }
}
