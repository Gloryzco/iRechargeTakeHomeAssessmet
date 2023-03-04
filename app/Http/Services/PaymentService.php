<?php

namespace App\Http\Services;

use App\HelperClass\ApiCaller;
use App\Http\Services\CustomerService;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentService
{
    use ApiCaller;

    public static function initiatePayment($request, $customer_id)
    {
        $customer = CustomerService::getOneCustomer($customer_id);
        $payment = self::paymentCreate($request, $customer->id);

        $data = [
            "card_number" => "5531886652142950",
            "cvv" => "564",
            "expiry_month" => "09",
            "expiry_year" => "32",
            "currency" => "NGN",
            "amount" => $payment->amount,
            "fullname" => $payment->customer->fullName,
            "email" => "stefan.wexler@hotmail.eu",
            "tx_ref" => $payment->transaction_id,
            "authorization" => [
                "mode" => "pin",
                "pin" => 3310
            ],
        ];

        $url = "/charges?type=card";
        $response = ApiCaller::post($url, $data);

        if ($response['data']['status'] === "successful" && $response['data']['amount'] === $payment->amount) {
            $payment->update(['status' => 'successful']);
        } else {
            $payment->update(['status' => 'pending']);
        }
        return $payment;
    }

    public static function paymentCreate($request, $customer_id)
    {
        $payment = Payment::create([
            'customer_id' => $customer_id,
            'transaction_id' => $request['transaction_id'],
            'payment_ref' => Str::random(16),
            'amount' =>  $request['amount'],
        ]);
        return $payment;
    }
}
