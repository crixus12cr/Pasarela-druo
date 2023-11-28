<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasarelas = [
            'Mercado Pago',
            'Druo',
            'Bold'
        ];

        foreach ($pasarelas as $key => $pasarela) {
            PaymentGateway::create([
                'name' => $pasarela
            ]);
        }
    }
}
