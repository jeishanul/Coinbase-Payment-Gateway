<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\PaymentRequest;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoinBaseController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function process(PaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $coin_pay_api_key = env('COIN_PAY_API_KEY');

            $transaction = Transaction::create([
                'amount' => $request->amount,
                'payment_status' => PaymentStatus::REVIEWED->value
            ]);

            $body = [
                'name' => "Testing purpose",
                'description' => "Pay for testing purpose",
                'pricing_type' => 'fixed_price',
                'local_price' => [
                    'amount' => $request->amount,
                    'currency' => 'USD'
                ],
                'redirect_url' => route('payment.completed', $transaction->id),
                'cancel_url' => route('payment.canceled', $transaction->id)
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
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Please provide a valid coin base API key');
        }
    }

    public function completed(Transaction $transaction)
    {
        $transaction->update([
            'payment_status' => PaymentStatus::PAID->value
        ]);

        return to_route('index')->with('success', 'Payment successfully completed.');
    }

    public function canceled(Transaction $transaction)
    {
        $transaction->update([
            'payment_status' => PaymentStatus::FAILED->value
        ]);

        return to_route('index')->with('error', 'Payment failed! please try again.');
    }
}
