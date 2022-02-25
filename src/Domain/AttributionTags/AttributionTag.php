<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags;

use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTagCore;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Concerns\InteractsWithAttributionTag;

class AttributionTag extends AttributionTagCore
{
    use InteractsWithAttributionTag;

    public function __construct()
    {
        parent::__construct();

        $this->useGetMethod();
    }

    protected function getHeaders(array $headers = []): array
    {
        $scopeHeaders = $this->getHeadersForScope();

        return parent::getHeaders(array_merge($scopeHeaders, $headers));
    }

    /**
     * @return array
     */
    protected function getHeadersForScope()
    {
        $clientId = $this->getClientId();
        $amazonApiAuthorization = AmazonAPIAuthorization::whereClientId($clientId)->first();
        $scope = $amazonApiAuthorization->scope;

        return [
            'Amazon-Advertising-API-Scope' => $scope,
        ];
    }

    public function getEndpoint(): string
    {
        $endpoint = parent::getEndpoint();

        return "/{$endpoint}/{$this->getAttributionTagType()}";
    }

    public function getParameters(): array
    {
        return $this->getAttributionTagParameters();
    }
}
