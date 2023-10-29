<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoinPayController extends Controller
{
    public function process()
    {
        try {
            $coin_pay_api_key = env('COIN_PAY_API_KEY');
            $body = [
                'name' => "Testing purpose",
                'description' => "Pay for testing purpose",
                'pricing_type' => 'fixed_price',
                'local_price' => [
                    'amount' => 10,
                    'currency' => 'USD'
                ],
                'redirect_url' => route('payment.completed'),
                'cancel_url' => route('payment.canceled')
            ];
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://api.commerce.coinbase.com/charges', [
                'body' => json_encode($body),
                'headers' => [
                    'X-CC-Api-Key' => $coin_pay_api_key,
                    'X-CC-Version' => '2018-03-22',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            $url  = json_decode($response->getBody()->getContents())->data->hosted_url;
            return redirect()->to($url);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function completed()
    {
    }

    public function canceled()
    {
    }
}
