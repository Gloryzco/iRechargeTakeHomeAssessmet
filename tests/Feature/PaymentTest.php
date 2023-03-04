<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

       /**
     * Test charging of a customer's card
     *
     * @return void
     */
    public function testChargeCustomerCard()
    {
        $customer = Customer::factory()->create();
        $paymentData = [
            "transaction_id" => Str::random(16),
            "amount" => 200,
        ];
        $response = $this->Json('POST','/api/customer/'.$customer->id.'/payment', $paymentData);
        $response->assertStatus(201);
        // $this->assertEquals($response['status'],'pending');
    }
}
