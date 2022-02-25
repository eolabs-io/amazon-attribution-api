<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports;

use EolabsIo\AmazonAttributionApi\Domain\Reports\ReportCore;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Concerns\InteractsWithReports;

class Report extends ReportCore
{
    use InteractsWithReports;


    protected function getHeaders(array $headers = []): array
    {
        $scopeHeaders = $this->getHeadersForScope();

        return parent::getHeaders(array_merge($scopeHeaders, $headers));
    }

    public function getParameters(): array
    {
        return $this->getReportParameters();
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
