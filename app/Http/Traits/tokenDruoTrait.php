<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait tokenDruoTrait {

    public function accesTokenDruo ()
    {
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
            $respuesta = json_decode($response);
            // return $response;
            // return $response->json();
            return $respuesta->access_token;
        } else {
            // $error = $response->json();
            return false;
        }
    }
}