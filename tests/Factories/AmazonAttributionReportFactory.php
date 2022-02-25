<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Tests\Factories\TokenProviderFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

class AmazonAttributionReportFactory
{
    private $endpoint = 'advertising-api.amazon.com/attribution/report';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakePerformanceReportResponse(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchPerformanceReportResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakePerformanceReportResponseWithCursorId(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchPerformanceReportWithCursorIdResponse.json';
        $responseWithCursorId = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchPerformanceReportResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($responseWithCursorId, 200)
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeProductReportResponse(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchProductReportResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeProductReportResponseWithCursorId(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchProductReportWithCursorIdResponse.json';
        $responseWithCursorId = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchProductReportResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($responseWithCursorId, 200)
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeTokenProvider()
    {
        AmazonAPIAuthorization::factory()->create([
            'client_id' =>  config('amazon-attribution-api.clientId'),
            'scope' => 1234567890,
        ]);

        TokenProviderFactory::new()->fakeRefreshTokenResponse();
    }
}
