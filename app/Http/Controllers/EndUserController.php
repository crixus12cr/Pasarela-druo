<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EndUserController extends Controller
{
    public function store()
    {
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InpSWGlvX2FPUjBjbDdoQloxZXVzeiJ9.eyJpc3MiOiJodHRwczovL2F1dGguZHJ1by5jb20vIiwic3ViIjoiSGd2aTFKTkR4Q2NmOE9vUG5oVGQwR3puWXRhT1BKQ3dAY2xpZW50cyIsImF1ZCI6Imh0dHBzOi8vZHJ1by1tZXJjaGFudC1hcGkuY29tIiwiaWF0IjoxNzAwNTc5NDI2LCJleHAiOjE3MDA2NjU4MjQsImF6cCI6IkhndmkxSk5EeENjZjhPb1BuaFRkMEd6bll0YU9QSkN3Iiwic2NvcGUiOiJyZWFkOnRyYW5zYWN0aW9ucyB3cml0ZTp0cmFuc2FjdGlvbnMgcmVhZDpjb25uZWN0IHdyaXRlOmNvbm5lY3Qgd3JpdGU6cGF5bWVudHMgcmVhZDpwYXltZW50cyByZWFkOmNvbm5lY3QtbGluayB3cml0ZTpjb25uZWN0LWxpbmsgd3JpdGU6YWNjb3VudHMgcmVhZDphY2NvdW50cyByZWFkOmVuZC11c2VycyB3cml0ZTplbmQtdXNlcnMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMifQ.hj0tFTW3reH8PrHcBqZym21IS1hGZt2oWiyJw2yyROzf22IJpGpFRQW9zfTYX7xHng05roURNp5SnLdt6ozfO8ePMvJk9B_GskCt2BpwBXd4AkRtRDLsNLgiE6rkzqh_iBD1fK2pAJu0L5KepwCJRG7bm03-D_s5h_febb4via4eFC7mAyiIlfkxfMkAkzg1UjQY_mlnlgLyxlLA0VzvmHhKijNdpWx4zr_sspjhdNqJxw1xg8XuiZPwVClriDLIX3R0P_AtF02Rv_Y24zxKMET1Bc9wr4wnDsAXDwnlJtHlO5mg9kY9Bs12dUVxmdH6mMLWrns8-q218E0BwkLB7A';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $token,
        ])->post('https://api.druo.com/end-users/create', [
            'type' => 'INDIVIDUAL',
            'email' => 'dpinilla@quan.com.co',
            'first_name' => 'Dario',
            'last_name' => 'Pinilla',
            'local_id' => '1058645484',
            'local_id_type' => 'NATIONAL_IDENTITY_CARD',
            'local_id_country' => 'COL',
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
