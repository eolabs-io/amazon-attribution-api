<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Publishers;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionPublisher;
use EolabsIo\AmazonAttributionApi\Tests\Factories\AmazonAttributionPublisherFactory;

class AmazonAttributionPublisherTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        AmazonAttributionPublisherFactory::new()->fakePublisherResponse();

        AmazonAttributionPublisher::fetch();

        Http::assertSent(function ($request) {
            return $request->url() == "https://advertising-api.amazon.com/attribution/publishers" &&
                   $request->method() == "GET" &&

            // Headers
                    $request->hasHeader('Amazon-Advertising-API-ClientId', 'amzn1.application-oa2-client.a925EXAMPLE0b302baf3e644a') &&
                    $request->hasHeader('Authorization', 'Bearer Atza|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
                    $request->hasHeader('Amazon-Advertising-API-Scope', 1234567890);
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        AmazonAttributionPublisherFactory::new()->fakePublisherResponse();

        $response = AmazonAttributionPublisher::fetch();

        $publishers = $response['publishers'];

        $this->assertCount(29, $publishers);

        $publisher = $publishers[0];

        $this->assertEquals('Google Ads', $publisher['name']);
        $this->assertEquals('1', $publisher['id']);
        $this->assertTrue($publisher['macroEnabled']);
    }
}
