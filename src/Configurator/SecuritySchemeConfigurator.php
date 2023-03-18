<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Configurator;

use Selency\OpenApi\Model\OauthFlows;
use Selency\OpenApi\Model\SecurityScheme;
use Selency\OpenApi\Model\SecuritySchemeIn;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class SecuritySchemeConfigurator
{
    use Traits\DescriptionTrait;
    use Traits\ExtensionsTrait;
    use Traits\NameTrait;

    private string $type = '';
    private ?SecuritySchemeIn $in = null;
    private ?string $scheme = null;
    private ?string $bearerFormat = null;
    private ?string $openIdConnectUrl = null;
    private ?OauthFlows $flows = null;

    public function build(): SecurityScheme
    {
        return new SecurityScheme(
            type: $this->type,
            name: $this->name,
            in: $this->in,
            scheme: $this->scheme,
            description: $this->description,
            bearerFormat: $this->bearerFormat,
            openIdConnectUrl: $this->openIdConnectUrl,
            flows: $this->flows,
            specificationExtensions: $this->specificationExtensions,
        );
    }

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function in(SecuritySchemeIn $in): static
    {
        $this->in = $in;

        return $this;
    }

    public function scheme(string $scheme): static
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function bearerFormat(string $bearerFormat): static
    {
        $this->bearerFormat = $bearerFormat;

        return $this;
    }

    public function openIdConnectUrl(string $openIdConnectUrl): static
    {
        $this->openIdConnectUrl = $openIdConnectUrl;

        return $this;
    }

    public function flows(OauthFlows $flows): static
    {
        $this->flows = $flows;

        return $this;
    }
}
