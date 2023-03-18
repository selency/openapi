<?php

/*
 * (c) Selency <tech@selency.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Selency\OpenApi\Model;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Selency Team <tech@selency.fr>
 */
class OauthFlows implements OpenApiModel
{
    use OpenApiTrait;

    public function __construct(
        private readonly ?OauthFlow $implicit = null,
        private readonly ?OauthFlow $password = null,
        private readonly ?OauthFlow $clientCredentials = null,
        private readonly ?OauthFlow $authorizationCode = null,
        private readonly array $specificationExtensions = [],
    ) {
    }

    public function getImplicit(): ?OauthFlow
    {
        return $this->implicit;
    }

    public function getPassword(): ?OauthFlow
    {
        return $this->password;
    }

    public function getClientCredentials(): ?OauthFlow
    {
        return $this->clientCredentials;
    }

    public function getAuthorizationCode(): ?OauthFlow
    {
        return $this->authorizationCode;
    }

    public function getSpecificationExtensions(): array
    {
        return $this->specificationExtensions;
    }

    public function toArray(): array
    {
        return array_filter([
            'implicit' => $this->getImplicit()?->toArray(),
            'password' => $this->getPassword()?->toArray(),
            'clientCredentials' => $this->getClientCredentials()?->toArray(),
            'authorizationCode' => $this->getAuthorizationCode()?->toArray(),
        ] + $this->getSpecificationExtensions());
    }
}
