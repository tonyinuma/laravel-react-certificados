<?php

use App\Http\Controllers\Api\CertificatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('certificates', [CertificatesController::class, 'list']);
Route::get('certificates/{id}', [CertificatesController::class, 'find']);
Route::post('certificates', [CertificatesController::class, 'store']);
Route::put('certificates/{id}', [CertificatesController::class, 'update']);
Route::delete('certificates/{id}', [CertificatesController::class, 'delete']);
