<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Shared;

use Exception;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

class TokenProvider
{
    private $endpoint = "https://api.amazon.com/auth/o2/token";

    private function getRefreshToken(): string
    {
        $clientId = config('amazon-attribution-api.clientId');

        $amazonAPIAuthorization = AmazonAPIAuthorization::whereClientId($clientId)->first();

        return $amazonAPIAuthorization->refresh_token;
    }

    public function getAccessToken(): string
    {
        try {
            $parameters = [
                'refresh_token' => $this->getRefreshToken(),
                'grant_type' => 'refresh_token',
                'client_id' => config('amazon-attribution-api.clientId'),
                'client_secret' => config('amazon-attribution-api.clientSecret'),
            ];

            $response = Http::post($this->endpoint, $parameters)->throw();
        } catch (Exception $exception) {
            // Handle exception
        }

        return $response['access_token'];
    }
}
