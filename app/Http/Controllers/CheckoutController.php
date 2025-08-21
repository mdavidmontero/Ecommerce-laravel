<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token);
        return view('checkout.index', compact('session_token'));
    }

    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        $auth = base64_encode($user . ':' . $password);
        return Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
        ])->get($url_api)->body();
    }

    public function generateSessionToken($access_token)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";
        $total = (float) Cart::instance('shopping')->subtotal() + 10;
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => (float) $total,
            'antifraud' => [
                'clientIp' => request()->ip(),
                'merchantDefineData' => [
                    'MDD4' => 'integraciones@niubiz.com.pe',
                    'MDD32' => 'JD1892639123',
                    'MDD75' => 'Registrado',
                    'MDD77' => 458,
                ]
            ],
            'dataMap' => [
                'cardholderCity' => 'Lima',
                'cardholderCountry' => 'PE',
                'cardholderAddress' => 'Av Jose Pardo 831',
                'cardholderPostalCode' => '12345',
                'cardholderState' => 'LIM',
                'cardholderPhoneNumber' => '987654321',

            ]

        ])->json();
        return $response['sessionKey'];
    }

    public function paid(Request $request)
    {
        $access_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])->post($url_api, [
            'channel' => 'web',
            'captureType' => 'manual',
            'countable' => true,
            'order' => [
                "tokenId" => $request->transactionToken,
                "purchaseNumber" => $request->purchaseNumber,
                "amount" => $request->amount,
                'currency' => 'USD',
            ]
        ])->json();
        session()->flash('niubiz', [
            'response' => $response,
            'purchaseNumber' => $request->purchaseNumber,
        ]);
        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            $address = Address::where('user_id', Auth::user()->id)->where('default', true)->first();
            Order::create(
                [
                    'user_id' => Auth::user()->id,
                    'content' => Cart::instance('shopping')->content(),
                    'address' => $address,
                    'payment_id' => $response['dataMap']['TRANSACTION_ID'],
                    'total' => (float) Cart::subtotal(),
                ]
            );
            Cart::destroy();
            return redirect()->route('gracias');
        }

        return redirect()->route('checkout.index');
    }
}
