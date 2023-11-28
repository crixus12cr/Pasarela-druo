<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OauthController extends Controller
{
    public function oauthToken()
    {
        /* curls */
        /* curl --location 'https://auth.druo.com/oauth/token' \
        --header 'Content-Type: application/json'  \
        --data '{
            "client_id": "{{client_id}}",
            "client_secret": "{{client_secret}}",
            "audience": "https://druo-merchant-api.com",
            "grant_type": "client_credentials"
        }' */


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
            ->post('https://auth.druo.com/oauth/token', [
                'client_id' => config('services.druo.key'),
                'client_secret' => config('services.druo.secret'),
                'audience' => 'https://druo-merchant-api.com',
                'grant_type' => 'client_credentials',
            ]);

        if ($response->successful()) {
            $token = $response['access_token'];
            $rta = json_decode($response);

            // return $rta->access_token;
            return $response->json();
        } else {
            $error = $response->json();
            return $error;
        }
    }
}
