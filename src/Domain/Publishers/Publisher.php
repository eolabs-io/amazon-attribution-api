<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers;

use EolabsIo\AmazonAttributionApi\Domain\Publishers\PublisherCore;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

class Publisher extends PublisherCore
{
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
}
