<?php

namespace App\Http\Controllers;

use App\Http\Traits\tokenDruoTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuscripcionDruoController extends Controller
{
    use tokenDruoTrait;
    public function suscripciones()
    {
        // return 'hola mundo';
        $accessToken = $this->accessTokenDruo();

        $fechaActual = Carbon::now('GMT');

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ])->post('https://api-staging.druo.com/recurring-plans/create', [
                "description" => "susucripcion de prueba", 
                "processing_method" => "AUTOMATIC",
                "start_date" => $fechaActual,
                "end_date" => $fechaActual->addYear(),
                "total_cycle_count" => "12",
                "cycle_frequency" => "MONTHLY",
                "origin_account_id" => "acc_2a421645-af9a-4797-a142-8b7d5a048274",
                "destination_account_id" => "acc_78a1c219-0a22-4a02-921a-126000c3cb3a",
                "statement_descriptor" => "suscripcion de prueba",
                "primary_reference" => "ABC123",
                "secondary_reference" => "otra referencia",
                "metadata" => [
                    "order_id" => "6735"
                ],
                "transaction" => [
                    "tenant_id" => "ten_35516d40-ca41-4fa3-885c-d13d0ccdae0a",
                    "type" => "PAYMENT",
                    // "currency" => "COP",
                    "amount" => 10000,
                    "statement_descriptor" => "NOVO BILLING* INV12324",
                    "primary_reference" => "Transaction primary reference",
                    "secondary_reference" => "Transaction secondary reference",
                    "metadata" => [
                        "transaction_xyz" => "JOHN SMITH",
                        "id_user" => "69440"
                    ]
                ],
                "existing_end_user_id" => "eur_a535b3a1-c8e3-4c60-9f27-a77f48c32109"
            ]);

            $statusCode = $response->status();

            if ($statusCode === 200) {
                $responseData = $response->json();
                return response()->json($responseData); 
            } else {
                
                return response()->json(['error' => 'Error en la solicitud'], $statusCode);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Error en la solicitud: ' . $e->getMessage()], 500);
        }
    }
}
