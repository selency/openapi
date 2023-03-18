<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator\Traits;

use Selency\OpenApi\Model\ServerVariable;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
trait ServerVariablesTrait
{
    /**
     * @var array<string, ServerVariable>
     */
    private array $variables = [];

    public function variable(string $name, string $default, string $description = null, array $enum = null, array $specificationExtensions = []): static
    {
        $this->variables[$name] = new ServerVariable($default, $description, $enum, $specificationExtensions);

        return $this;
    }
}
