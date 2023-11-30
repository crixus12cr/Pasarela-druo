<?php

namespace App\Http\Controllers;

use App\Http\Traits\tokenDruoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentDruoController extends Controller
{
    use tokenDruoTrait;
    public function generateCheckoutLink()
    {
        $accessToken = $this->accessTokenDruo();


        $response = Http::withHeaders([
            'DRUO-Version' => '2021-11-22',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post('https://api.druo.com/checkout/link/create', [
            'existing_end_user_id' => 'eur_0fe3d4f8-c55d-4d63-bd08-6fd0847dc9f8',
            'link_name' => 'Paga_tu_plan_con_Druo',
            'transaction' => [
                'tenant_id' => 'ten_35516d40-ca41-4fa3-885c-d13d0ccdae0a',
                'amount' => 560000,
                'description' => 'Paga tu primera cuota de inscripcion a nuestra plataforma Quan',
                'statement_descriptor' => 'NOVO BILLING* INV12324',
                'auto_send_receipt' => false,
            ],
        ]);
        return $response->json();
        if ($response->successful()) {
            return 'entro';
            return $response->json();
        } else {
            return false;
        }

    }
}
