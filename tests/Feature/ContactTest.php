<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * Load Contact Form page 
     */
    public function test_contact_page_successfully_load()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    /**
     * Submit contact from contact form
     */
    public function test_new_contact_can_register()
    {
        $response = $this->post('/contact/detail', [
            'name'    => 'Test Contact User',
            'email'   => 'testcontact@example.com',
            'phone'   => '+861234567',
            'budget'  => 50,
            'wp_account' => 0,
            'message' => 'This is Test Message',
        ]);

        $response->assertStatus(302);
    }

    /**
     * Load customer List page
     */
    public function test_customer_list_page_load_successfully()
    {
        $response = $this->get('/customers');
        $response->assertStatus(200);
    }

    /**
     * Create WordPress account
     */
    public function test_wordpress_account_can_create()
    {
        $response = $this->post('/customers/create', [
            'id'  => 1
        ]);

        $response->assertStatus(200);
    }
}
