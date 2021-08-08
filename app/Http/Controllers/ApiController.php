<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function api_cites()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.speciesplus.net/api/v1/taxon_concepts";

        $headers= [
            'Authorization' => "barrea uD2JyZT7CvR1Snol3xKrYgtt ",
        ];

        $response = $client->request('GET', $url, [
            'verify'  => false,
            'headers' => $headers,
        ]);

        $responseBody = json_decode($response);

        return $responseBody;
    }
}
