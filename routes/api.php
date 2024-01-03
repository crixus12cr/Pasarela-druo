<?php

use App\Http\Controllers\ConnectAccountController;
use App\Http\Controllers\EndUserController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDruoController;
use App\Http\Controllers\SuscripcionDruoController;
use App\Http\Controllers\TestUcontacController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/token', [OauthController::class, 'oauthToken']);
Route::get('/pagar', [PaymentController::class, 'payments']);
Route::get('/crear-usuario-final', [EndUserController::class, 'store']);
Route::get('/enviar-link', [ConnectAccountController::class, 'connectLink']);

/* ---- */
Route::get('/tokenUcontac', [TestUcontacController::class, 'tokenUcontac']);
Route::get('/sendPlantilla', [TestUcontacController::class, 'envioHsm']);

/* checkoutLink */
Route::get('/send-checkoutLink', [PaymentDruoController::class, 'generateCheckoutLink']);

Route::get('/test', function () {

    $data = 'Hola Mundo 2';

    logger()->channel('custom')->info($data);

    return 'verificar';
});

/* suscripciones recurrentes con druo */
Route::get('/suscripcion', [SuscripcionDruoController::class, 'suscripciones']);