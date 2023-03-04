<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test customer creation
     *
     * @return void
     */
    public function testCreateCustomer()
    {
        $response = $this->postJson(url('/api/customers'), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
           
        ]);
        

        $response->assertStatus(201);
        $this->assertArrayHasKey('data',$response);
        
    }
}