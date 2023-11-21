<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

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

        // Realizar la solicitud a la API de Druo
        $response = Http::withHeaders([
            "DRUO-Version" => "2021-11-22",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer $token" // Reemplaza ACCESS_TOKEN
        ])->post('https://api.druo.com/payments/create', $data);

        // Manejar la respuesta de la solicitud
        if ($response->successful()) {
            // La solicitud fue exitosa (código de respuesta en el rango 2xx)
            $responseData = $response->json(); // Obtener los datos de la respuesta en formato JSON

            // Aquí puedes manejar los datos de la respuesta, por ejemplo:
            $paymentId = $responseData['payment_id'];
            // ...hacer algo con el ID del pago

            // Retornar la respuesta o hacer más acciones con ella según tu lógica de aplicación
            return response()->json($responseData);
        } else {
            // La solicitud no fue exitosa, manejar el error
            $errorResponse = $response->json(); // Obtener los datos del error en formato JSON

            // Aquí puedes manejar el error, por ejemplo:
            $errorMessage = $errorResponse['message'];
            // ...hacer algo con el mensaje de error

            // Retornar un mensaje de error o realizar acciones según tu lógica de manejo de errores
            return response()->json(['error' => $errorMessage], $response->status());
        }
    }

    public function payments()
    {

        // Tu lógica para obtener el ACCESS_TOKEN, por ejemplo, desde la autenticación de tu usuario
        $accessToken = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InpSWGlvX2FPUjBjbDdoQloxZXVzeiJ9.eyJpc3MiOiJodHRwczovL2F1dGguZHJ1by5jb20vIiwic3ViIjoiSGd2aTFKTkR4Q2NmOE9vUG5oVGQwR3puWXRhT1BKQ3dAY2xpZW50cyIsImF1ZCI6Imh0dHBzOi8vZHJ1by1tZXJjaGFudC1hcGkuY29tIiwiaWF0IjoxNzAwNTY4MDc1LCJleHAiOjE3MDA2NTQ0NzMsImF6cCI6IkhndmkxSk5EeENjZjhPb1BuaFRkMEd6bll0YU9QSkN3Iiwic2NvcGUiOiJyZWFkOnRyYW5zYWN0aW9ucyB3cml0ZTp0cmFuc2FjdGlvbnMgcmVhZDpjb25uZWN0IHdyaXRlOmNvbm5lY3Qgd3JpdGU6cGF5bWVudHMgcmVhZDpwYXltZW50cyByZWFkOmNvbm5lY3QtbGluayB3cml0ZTpjb25uZWN0LWxpbmsgd3JpdGU6YWNjb3VudHMgcmVhZDphY2NvdW50cyByZWFkOmVuZC11c2VycyB3cml0ZTplbmQtdXNlcnMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMifQ.RUOG8Z6_0eK1XBehVo1DslTPUMqoJ5vBA0EqiMK6TtIoJjgtiz1Xs53sLWdz2HoqQ__Q1g_AcMPkCoYNSVNELL-U4RKqKOuM9Iex98082rd7-Xw6Yc1n8skt8mzCeozpCOlBIFtLyppumxi86d1idk5sVU8X3K8zrYBTFNW380VtUybnGnnPOV8AVKM9deIRBNtaz_3VkXQEnUnQoXKEc99rDOERp3XHXLkCTbJmPNmhnnqRh8vaZZ81RZiISUaFD6I4XA0lrF07HSN44YP16_ymw2Sbcze2H6SoH7j91Ixa8pW9OE5ZC6_TULrKbmzb7VKnfoOK0mp9V7hW-tdbug';

        $response = Http::withHeaders([
            'DRUO-Version' => '2021-11-22',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post('https://api.druo.com/payments/create', [
            "tenant_id" => "ten_35516d40-ca41-4fa3-885c-d13d0ccdae0a",
            "amount" => "20000",
            "description" => "Insurance policy renewal - INV12324",
            "statement_descriptor" => "NOVO BILLING* INV12324",
            "auto_send_receipt" => false,
            "funding_source_id" => "acc_8e2964c3-7ba1-4d15-8887-d7bd71533254"
        ]);

        if ($response->successful()) {
            // Si la solicitud fue exitosa, puedes acceder a los datos de la respuesta
            $responseData = $response->json();
            // Hacer algo con $responseData, por ejemplo:
            return response()->json($responseData);
        } else {
            // Si hubo un error en la solicitud, puedes manejarlo aquí
            $errorCode = $response->status();
            $errorResponse = $response->json();
            // Hacer algo con el error, por ejemplo:
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
            // Utiliza el token para acceder a la API de DRUO
            return $response->json();
        } else {
            // Manejar la respuesta de error si la solicitud no fue exitosa
            $error = $response->json();
            return $error;
        }
    }
}
