<?php

namespace App\Http\Controllers;

use App\Http\Traits\tokenDruoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EndUserController extends Controller
{
    use tokenDruoTrait;
    public function store()
    {
        $token = $this->accessTokenDruo();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $token,
        ])->post('https://api.druo.com/end-users/create', [
            'type' => 'INDIVIDUAL',
            'email' => 'cperdomo@arcetec.com.co',
            'first_name' => 'usuarigreo_ra',
            'last_name' => 'randdom',
            'local_id' => '146897659',
            'local_id_type' => 'NATIONAL_IDENTITY_CARD',
            'local_id_country' => 'COL',
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            return response()->json($responseData);
        } else {
            $errorMessage = $response->body();
            return response($errorMessage);
        }
    }
}
