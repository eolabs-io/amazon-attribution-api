<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Tests\Factories\TokenProviderFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

class AmazonAttributionPublisherFactory
{
    private $endpoint = 'advertising-api.amazon.com/attribution/publishers';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakePublisherResponse(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchPublisherResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
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
