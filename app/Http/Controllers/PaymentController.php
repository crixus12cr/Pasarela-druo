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
        $accessToken = '4ZGlJVahLoSSiitA3pxoBw0vHzmHX7kVZbm0Gg3D_bfn9vKeVOlkouYpqBdd0viP';

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
            "funding_source_id" => "acc_f5f1cd79-5efe-4a21-b516-f586dc9105b7"
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
}
