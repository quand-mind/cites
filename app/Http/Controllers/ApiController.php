<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function api_cites()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.speciesplus.net/api/v1/taxon_concepts";

        $headers= [
            // 'Content-Type' => 'application/json',
            'X-Authentication-Token' => 'uD2JyZT7CvR1Snol3xKrYgtt',
        ];
        if (env('APP_ENV') === 'local') {
            $response = $client->request('GET', $url, [
                'verify'  => false,
                'headers' => $headers,
            ]);
        } else {
            $response = $client->request('GET', $url, [
                'verify'  => true,
                'headers' => $headers,
            ]);
        }


        $species = json_decode($response->getBody()->getContents());

        return $species;
        // return view('species', compact('species'));
    }
}
