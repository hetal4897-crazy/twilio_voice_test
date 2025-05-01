<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Twilio\TwiML\VoiceResponse;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::post('/twilio/voice', function (Request $request) {
    $response = new VoiceResponse();

    $response->start()->stream([
        'url' => 'wss://devapi.ivoz.ai/llm-campaigns/ws/groq/?bot=ivoz',
    ]);

    $response->say('Hello. Your call is now being streamed.');
    $response->pause(['length' => 60]); // Keep the call open

    return response($response)->header('Content-Type', 'text/xml');
});