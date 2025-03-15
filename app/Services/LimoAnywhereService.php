<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class LimoAnywhereService
{
    protected $client;
    protected $clientId;
    protected $clientSecret;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->clientId = env('LIMO_CLIENT_ID');
        $this->clientSecret = env('LIMO_CLIENT_SECRET');
    }

    public function getAccessToken()
{
    try {
      
        Log::info('LimoAnywhere Client ID:', ['client_id' => config('services.limoanywhere.client_id')]);
        Log::info('LimoAnywhere Client Secret:', ['client_secret' => config('services.limoanywhere.client_secret')]);

        $response = $this->client->post('https://api.mylimobiz.com/v0/oauth2/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('services.limoanywhere.client_id'),
                'client_secret' => config('services.limoanywhere.client_secret'),
            ],
            'timeout' => 30,
        ]);

        $data = json_decode($response->getBody(), true);
        
        // ✅ Debug API response
        Log::info('Access Token Response:', $data);

        if (!isset($data['access_token'])) {
            throw new \Exception("Access token not found in API response.");
        }

        return $data['access_token'];
    } catch (\Exception $e) {
        Log::error('Access Token Error: ' . $e->getMessage());
        return null;
    }
}

}