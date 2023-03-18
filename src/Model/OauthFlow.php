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
class OauthFlow implements OpenApiModel
{
    use OpenApiTrait;

    /**
     * @param array<string, string> $scopes
     */
    public function __construct(
        private readonly string $authorizationUrl,
        private readonly string $tokenUrl,
        private readonly array $scopes = [],
        private readonly ?string $refreshUrl = null,
        private readonly array $specificationExtensions = [],
    ) {
    }

    public function getAuthorizationUrl(): string
    {
        return $this->authorizationUrl;
    }

    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    /**
     * @return array<string, string>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getRefreshUrl(): ?string
    {
        return $this->refreshUrl;
    }

    public function getSpecificationExtensions(): array
    {
        return $this->specificationExtensions;
    }

    public function toArray(): array
    {
        return array_filter([
            'authorizationUrl' => $this->getAuthorizationUrl(),
            'tokenUrl' => $this->getTokenUrl(),
            'refreshUrl' => $this->getRefreshUrl(),
            'scopes' => $this->normalizeCollection($this->getScopes()),
        ] + $this->getSpecificationExtensions());
    }
}
