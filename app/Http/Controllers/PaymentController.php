<?php

namespace App\Http\Controllers;

use App\Http\Traits\tokenDruoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    use tokenDruoTrait;
    public function paymentss()
    {
        /* curlss de druo */

        /* curl --location 'https://api.druo.com/payments/create' \
        --header 'DRUO-Version: 2021-11-22' \
        --header 'Content-Type: application/json' \
        --header 'Authorization: Bearer ACCESS_TOKEN' \
        --data '{
            "tenant_id": "ten_35516d40-ca41-4fa3-885c-d13d0ccdae0a",
            "amount": "20000",
            "description": "Insurance policy renewal - INV12324",
            "statement_descriptor": "NOVO BILLING* INV12324",
            "auto_send_receipt": false,
            "funding_source_id": "acc_f5f1cd79-5efe-4a21-b516-f586dc9105b7"
        }' */
        $tenant_id = config('services.druo.tenant');
        $token = config('services.druo.secret');

        // Parámetros para la solicitud
        $data = [
            "tenant_id" => $tenant_id,
            "amount" => "200000",
            "description" => "Servicio en línea",
            "statement_descriptor" => "Descripción breve",
            "auto_send_receipt" => false,
            "funding_source_id" => "acc_8e2964c3-7ba1-4d15-8887-d7bd71533254"
        ];

        $response = Http::withHeaders([
            "DRUO-Version" => "2021-11-22",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer $token"
        ])->post('https://api.druo.com/payments/create', $data);

        if ($response->successful()) {
            $responseData = $response->json(); 

            $paymentId = $responseData['payment_id'];

            return response()->json($responseData);
        } else {
            $errorResponse = $response->json(); 

            $errorMessage = $errorResponse['message'];

            return response()->json(['error' => $errorMessage], $response->status());
        }
    }

    public function payments()
    {

        $accessToken = $this->accessTokenDruo();

        $response = Http::withHeaders([
            'DRUO-Version' => '2021-11-22',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post('https://api.druo.com/payments/create', [
            "tenant_id" => "ten_35516d40-ca41-4fa3-885c-d13d0ccdae0a",
            "amount" => "2000000",
            "description" => "Test 12321",
            "statement_descriptor" => "Otrasdfdsd",
            "auto_send_receipt" => false,
            "funding_source_id" => "acc_8e2964c3-7ba1-4d15-8887-d7bd71533254",
            "primary_reference" => "1"
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        } else {
            $errorCode = $response->status();
            $errorResponse = $response->json();
            return response()->json(['error' => $errorResponse], $errorCode);
        }
    }

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
            return $response->json();
        } else {
            $error = $response->json();
            return $error;
        }
    }
}
