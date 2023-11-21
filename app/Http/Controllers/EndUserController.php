<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EndUserController extends Controller
{
    public function store()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ACCESS_TOKEN',
        ])->post('https://api.druo.com/end-users/create', [
            'type' => 'INDIVIDUAL',
            'email' => 'john.doe@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'local_id' => '987654321',
            'local_id_type' => 'DRIVERS_LICENSE',
            'local_id_country' => 'USA',
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
        } else {
            $errorMessage = $response->body();
        }
    }
}
