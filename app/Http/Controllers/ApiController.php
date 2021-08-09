<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function api_cites()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.speciesplus.net/api/v1/taxon_concepts";

        $headers= [
            'X-Authentication-Token' => "uD2JyZT7CvR1Snol3xKrYgtt",
        ];

        $response = $client->request('GET', $url, [
            'verify'  => false,
            'headers' => $headers,
        ]);

        $responseBody = json_decode($response->getBody());

        return $responseBody;
        //return view('species_cite', compact('responseBody'));
    }
}
