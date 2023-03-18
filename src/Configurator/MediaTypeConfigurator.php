<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\Encoding;
use Selency\OpenApi\Model\MediaType;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class MediaTypeConfigurator
{
    use Traits\ExamplesTrait;
    use Traits\ExtensionsTrait;
    use Traits\SchemaTrait;

    /**
     * @var array<string, Encoding>
     */
    private array $encodings = [];

    public function build(): MediaType
    {
        return new MediaType(
            $this->schema,
            $this->example,
            $this->examples ?: null,
            $this->encodings ?: null,
            $this->specificationExtensions,
        );
    }

    public function encoding(string $name, EncodingConfigurator $encoding): static
    {
        $this->encodings[$name] = $encoding->build();

        return $this;
    }
}
