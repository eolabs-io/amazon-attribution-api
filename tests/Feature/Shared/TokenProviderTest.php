<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Shared;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Domain\Shared\TokenProvider;
use EolabsIo\AmazonAttributionApi\Tests\Factories\TokenProviderFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

class TokenProviderTest extends TestCase
{
    private $amazonAPIAuthorization;

    protected function setUp(): void
    {
        parent::setUp();

        $this->amazonAPIAuthorization = AmazonAPIAuthorization::factory()->create([
            'client_id' =>  config('amazon-attribution-api.clientId'),
        ]);

        TokenProviderFactory::new()->fakeRefreshTokenResponse();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        $tokenProvider = new TokenProvider();

        $accessToken = $tokenProvider->getAccessToken();

        Http::assertSent(function ($request) {
            return $request->url() == "https://api.amazon.com/auth/o2/token" &&
                   $request['refresh_token'] == $this->amazonAPIAuthorization->refresh_token &&
                   $request['grant_type'] == 'refresh_token' &&
                   $request['client_id'] == 'amzn1.application-oa2-client.a925EXAMPLE0b302baf3e644a' &&
                   $request['client_secret'] == 'EXAMPLE0b302baf3e644a2baf3e62baf3e';
        });

        $this->assertEquals('Atza|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw', $accessToken);
    }
}
