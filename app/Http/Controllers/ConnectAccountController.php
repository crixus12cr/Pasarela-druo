<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConnectAccountController extends Controller
{

    public $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InpSWGlvX2FPUjBjbDdoQloxZXVzeiJ9.eyJpc3MiOiJodHRwczovL2F1dGguZHJ1by5jb20vIiwic3ViIjoiSGd2aTFKTkR4Q2NmOE9vUG5oVGQwR3puWXRhT1BKQ3dAY2xpZW50cyIsImF1ZCI6Imh0dHBzOi8vZHJ1by1tZXJjaGFudC1hcGkuY29tIiwiaWF0IjoxNzAwNTg0Mjg2LCJleHAiOjE3MDA2NzA2ODQsImF6cCI6IkhndmkxSk5EeENjZjhPb1BuaFRkMEd6bll0YU9QSkN3Iiwic2NvcGUiOiJyZWFkOnRyYW5zYWN0aW9ucyB3cml0ZTp0cmFuc2FjdGlvbnMgcmVhZDpjb25uZWN0IHdyaXRlOmNvbm5lY3Qgd3JpdGU6cGF5bWVudHMgcmVhZDpwYXltZW50cyByZWFkOmNvbm5lY3QtbGluayB3cml0ZTpjb25uZWN0LWxpbmsgd3JpdGU6YWNjb3VudHMgcmVhZDphY2NvdW50cyByZWFkOmVuZC11c2VycyB3cml0ZTplbmQtdXNlcnMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMifQ.ls5dtsx2A-CGLxN1RhmKh2_QdPyrFFQW_Sq1yiv8NMpwTOVkarxcH9kD0XmzC-Z1PgdqI3rr4fZSybuQsHJtHoZyyG0ywZR2rnzOGoiKGCxnhdgYaHgf6mtmcu-ekJN30BQDNq-w0IkHIHgo2Ecc27IyLXLnuyzwPNANrxW5bOHGeZGBm_FqcMQytzmFHY2Q7dPmuprHSRUV_-Oko0LhGSauHbMSHCNfoxYMsf9LfTSYze0Yk8sxvw4s6IIb9rCqdK2rWaOLQkZHHpgC7Ka1mJbLZUceDZORMXfTjl_05t1dsi_OC-VMkRrJq-T5F3rCDztArCAtgUQIkw00HdW1hg';

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
            'Authorization' => 'Bearer '.$this->token,
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
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InpSWGlvX2FPUjBjbDdoQloxZXVzeiJ9.eyJpc3MiOiJodHRwczovL2F1dGguZHJ1by5jb20vIiwic3ViIjoiSGd2aTFKTkR4Q2NmOE9vUG5oVGQwR3puWXRhT1BKQ3dAY2xpZW50cyIsImF1ZCI6Imh0dHBzOi8vZHJ1by1tZXJjaGFudC1hcGkuY29tIiwiaWF0IjoxNzAwNTg0Mjg2LCJleHAiOjE3MDA2NzA2ODQsImF6cCI6IkhndmkxSk5EeENjZjhPb1BuaFRkMEd6bll0YU9QSkN3Iiwic2NvcGUiOiJyZWFkOnRyYW5zYWN0aW9ucyB3cml0ZTp0cmFuc2FjdGlvbnMgcmVhZDpjb25uZWN0IHdyaXRlOmNvbm5lY3Qgd3JpdGU6cGF5bWVudHMgcmVhZDpwYXltZW50cyByZWFkOmNvbm5lY3QtbGluayB3cml0ZTpjb25uZWN0LWxpbmsgd3JpdGU6YWNjb3VudHMgcmVhZDphY2NvdW50cyByZWFkOmVuZC11c2VycyB3cml0ZTplbmQtdXNlcnMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMifQ.ls5dtsx2A-CGLxN1RhmKh2_QdPyrFFQW_Sq1yiv8NMpwTOVkarxcH9kD0XmzC-Z1PgdqI3rr4fZSybuQsHJtHoZyyG0ywZR2rnzOGoiKGCxnhdgYaHgf6mtmcu-ekJN30BQDNq-w0IkHIHgo2Ecc27IyLXLnuyzwPNANrxW5bOHGeZGBm_FqcMQytzmFHY2Q7dPmuprHSRUV_-Oko0LhGSauHbMSHCNfoxYMsf9LfTSYze0Yk8sxvw4s6IIb9rCqdK2rWaOLQkZHHpgC7Ka1mJbLZUceDZORMXfTjl_05t1dsi_OC-VMkRrJq-T5F3rCDztArCAtgUQIkw00HdW1hg';
        /* curls */
       /*  curl --location 'https://api.druo.com/connect/link/create' \
        --header 'DRUO-Version: 2021-11-22' \
        --header 'Content-Type: application/json' \
        --header 'Authorization: Bearer ACCESS_TOKEN' \
        --data-raw '{
            "existing_end_user_id": "eur_868d99a5-6578-40cf-8aec-e7a48085fa37",
            "intro_text": "Connect your account using DRUO to receive or make payments"
        }' */

        $response = Http::withHeaders([
            'DRUO-Version' => '2021-11-22',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ])->post('https://api.druo.com/connect/link/create',[
            "existing_end_user_id" => "eur_b224dc9c-6130-426c-8f63-57dce4832d98",
            "intro_text" =>  "Hola Dario esta es una prueba para el link, en cuenta pon los digitos terminados en 4"
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
