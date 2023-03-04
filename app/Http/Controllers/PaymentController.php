<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Services\PaymentService;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function initiate(Request $request, $customer_id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'transaction_id' => 'required|string',
                'amount' => 'required|numeric|min:0',
            ],
        );
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $payment = PaymentService::initiatePayment($request->toArray(), $customer_id);

        return response()->json(['message' => 'Transaction initiated successfully', 'data' => $payment], 201);
    }

    public function getPaymentByCustomerId($customer_id)
    {
        $payment = Payment::where('customer_id', $customer_id)->get();
        if (!$payment) {
            throw new NotFoundException(false, 'Record not found', 404);
        }
        return response()->json([
            'message' => 'Payments fetched successfully',
            'payment' => $payment
        ], 200);
    }
}
