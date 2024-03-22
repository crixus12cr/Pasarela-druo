<?php

namespace App\Http\Controllers;

use App\Http\Traits\tokenDruoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConnectAccountController extends Controller
{

    use tokenDruoTrait;

    public function connecAccount()
    {
        /* curls */
        /* curl --location 'https://api.druo.com/accounts/connect' \
        --header 'DRUO-Version: 2021-11-22' \
        --header 'Content-Type: application/json' \
        --header 'Authorization: Bearer ACCESS_TOKEN' \
        --data-raw '{
            "user_authorization": true,
            "institution_uuid": "ins_9082d56c-4e1d-4967-a828-b7001755e88e",
            "type": "DEPOSITORY",
            "subtype": "SAVINGS",
            "account_number": "1234567894",
            "new_end_user_details": {
                "type":"INDIVIDUAL",
                "email": "j.doe@example.com",
                "first_name": "John",
                "last_name": "Doe",
                "local_id": "123456789",
                "local_id_type": "NATIONAL_IDENTITY_CARD",
                "local_id_country": "USA"
          }
        }' */

        $response = Http::withHeaders([
            'DRUO-Version' => '2021-11-22',
            'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer '.$this->token,
        ])->post('https://api.druo.com/accounts/connect', [
            'user_authorization' => true,
            'institution_uuid' => 'ins_9082d56c-4e1d-4967-a828-b7001755e88e',
            'type' => 'DEPOSITORY',
            'subtype' => 'SAVINGS',
            'account_number' => '1234567894',
            'new_end_user_details' => [
                'type' => 'INDIVIDUAL',
                'email' => 'j.doe@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'local_id' => '123456789',
                'local_id_type' => 'NATIONAL_IDENTITY_CARD',
                'local_id_country' => 'USA',
            ],
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
        } else {
            $errorMessage = $response->body();
        }
    }

    /* enviar link */

    public function connectLink()
    {
        $token =  $token = $this->accessTokenDruo();

        $data = [
            'subject_id' => 1,
            'plan_id' => 35,
            'customer_id' => 89
        ];

        $response = Http::withHeaders([
            'DRUO-Version' => '2021-11-22',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ])->post('https://api.druo.com/connect/link/create',[
            "existing_end_user_id" => "eur_b224dc9c-6130-426c-8f63-57dce4832d98",
            "intro_text" =>  "Hola Dario esta es una prueba para el link, en cuenta pon los digitos terminados en 4",
            "redirect_url" => "https://www.youtube.com/watch?v=F9YJS4nTNsM&list=RDmhJh5_6MuCk&index=14",
            "primary_reference" => "1234567894",
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
