<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.rumahsakit_api.base_uri');
    }

    public function get($endpoint)
    {
        $response = Http::get($this->baseUrl . '/' . $endpoint);

        if ($response->successful()) {
            $json = $response->json();

            // Ambil data yang ada di dalam key 'data'
            if (isset($json['data'])) {
                return $json['data'];
            }

            return $json; // fallback
        }

        \Log::error("GET $endpoint failed: " . $response->status());
        return null;
    }

    public function post($endpoint, $data)
    {
        $response = Http::post($this->baseUrl . '/' . $endpoint, $data);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error("POST $endpoint failed: " . $response->status());
        return null;
    }

    public function put($endpoint, $data)
    {
        $response = Http::put($this->baseUrl . '/' . $endpoint, $data);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error("PUT $endpoint failed: " . $response->status());
        return null;
    }

    public function delete($endpoint)
    {
        $response = Http::delete($this->baseUrl . '/' . $endpoint);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error("DELETE $endpoint failed: " . $response->status());
        return null;
    }
}
