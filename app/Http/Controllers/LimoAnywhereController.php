<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LimoAnywhereService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class LimoAnywhereController extends Controller
{
    protected $limoService;
    protected $client;

    public function __construct(LimoAnywhereService $limoService, Client $client)
    {
        $this->limoService = $limoService;
        $this->client = $client;
    }

    public function showForm()
    {
        return view('form');
    }

    public function getRates(Request $request)
    {
        $validated = $request->validate([
            'pickup_location' => 'required|string',
            'dropoff_location' => 'required|string',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'passenger_count' => 'required|integer|min:1',
        ]);

        try {

            $accessToken = $this->limoService->getAccessToken();

            if (!$accessToken) {
                throw new \Exception("Failed to retrieve access token.");
            }


        $requestData = [
            'passenger_count' => $validated['passenger_count'],
            'scheduled_pickup_at' => $validated['pickup_date'] . 'T' . $validated['pickup_time'] . ':00',
            'pickup' => [
                'type' => 'address',
                'address' => [
                    'address_line1' => $validated['pickup_location'],
                    'city' => 'New York',
                    'state_code' => 'NY',
                    'country_code' => 'US',
                ]
            ],
            'dropoff' => [
                'type' => 'address',
                'address' => [
                    'address_line1' => $validated['dropoff_location'],
                    'city' => 'New York',
                    'state_code' => 'NY',
                    'country_code' => 'US',
                ]
            ],
        ];


        $response = $this->client->post('https://api.mylimobiz.com/v0/companies/mayfairbv/rate_lookup', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $requestData,
        ]);

        $data = json_decode($response->getBody(), true);

            // ✅ Step 4: Log API response for debugging
            Log::info('Rate Lookup API Response:', $data);

            if (!isset($data['results']) || !is_array($data['results'])) {
                throw new \Exception("Invalid API response structure.");
            }

            return view('result', ['rates' => $data['results']]);
        } catch (\Exception $e) {
            Log::error('LimoAnywhere API Error: ' . $e->getMessage());
            return back()->with('error', 'API request failed: ' . $e->getMessage());
        }
    }
}