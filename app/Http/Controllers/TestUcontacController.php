<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestUcontacController extends Controller
{
    public function tokenUcontac()
    {

        $user = 'UserAPIQuan';
        $password = 'Cbzvgda2TijoU1L0v90asg==';

        $response = Http::asForm()->post('https://s3a.ucontactcloud.com/Integra/resources/auth/getUserToken', [
            'user' => $user,
            'password' => $password
        ]);

        if ($response->successful()) {
            
            $responseData = $response->json(); 
            
            return $responseData;
            
        } else {
           
            $errorResponse = $response->json(); 
            
            return $errorResponse;
            
        }
    }

    // public function envioHsm()
    // {

    //     try {

    //         $token = 'VXNlckFQSVF1YW46YTgwODRmZDUtNDRiYi00OGQyLTliYjAtYzY5MmMxOWJjZTk3';
    //         $hsm = 'hsm%3B5e49de34-7eb3-4d38-b017-6c67ec4f5cd5%3Btext%3B123456789';
        
    //         $response = Http::withHeaders([
    //             'authorization' => 'Basic '.$token,
    //             'Content-Type' => 'application/x-www-form-urlencoded',
    //         ])->post('https://s3a.ucontactcloud.com/Integra/resources/SMS/SendSMSDialer', [
    //             'message' => $hsm,
    //             'destination' => '573125620823',
    //             'dialerName' => 'WhatsAppDialerQuanAPI',
    //             'agent' => 'UserAPIQuan',
    //         ]);
        
    //         if ($response->successful()) {
    //             $responseData = $response->body(); 
                
    //             return $responseData;
    //         } else {
                
    //             $errorResponse = $response->json(); 
                
    //             return response()->json([
    //                 'status' => 'Error general',
    //                 'message' => $errorResponse
    //             ]);
    //         }
    //     } catch (\Exception $e) {
            
    //         return 'Excepción: '.$e->getMessage();
    //     }
    // }

    public function envioHsm()
    {
            $token = 'VXNlckFQSVF1YW46NzJjMTYzYTEtYTVhMy00NjhkLWE1ZjAtYWFkOWMxMjliZjUw';
            // $hsm = 'hsm;5e49de34-7eb3-4d38-b017-6c67ec4f5cd5;text;123456789'; envio de otp
            $hsm = 'hsm;e4381fc7-16a0-493e-80e1-82bbefd1175a;text;var'; //envio de link
            $destination = '573235249616';
        
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://s3a.ucontactcloud.com/Integra/resources/SMS/SendSMSDialer');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'message' => $hsm,
                'destination' => $destination,
                'dialerName' => 'WhatsAppDialerQuanAPI',
                'agent' => 'UserAPIQuan',
            ]));
            
            $headers = [
                'authorization: Basic ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ];
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $decodedResult = json_decode($result); // Decodificar la respuesta JSON
                var_dump($decodedResult); // Manejar la respuesta JSON como un objeto PHP
            }
            
            curl_close($ch);
    }
}
