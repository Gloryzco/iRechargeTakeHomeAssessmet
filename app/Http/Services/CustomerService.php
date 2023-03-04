<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Models\Customer;
use Exception;

class CustomerService
{
    public static function getOneCustomer($customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            throw new NotFoundException(false, 'Customer not found', 404);
        }
        return $customer;
    }

    public static function createCustomer($request)
    {
        $customer = Customer::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
        ]);
        return response()->json(['message' => 'Customer created successfully', 'data' => $customer], 201);
    }
}
