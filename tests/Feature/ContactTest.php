<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ContactTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->customer = Contact::factory()->create();
    }

    /**
     * Load Contact Form page 
     */
    public function test_contact_page_successfully_load()
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * In the case of name is not provided in contact form
     */
    public function test_contact_request_should_fail_when_no_name_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('contact.store'), [
                'email'   => $this->faker->unique()->safeEmail(),
                'phone'   => '+1' . $this->faker->numerify('##########'),
                'budget'  => $this->faker->numberBetween(1, 50),
                'wp_account' => 0,
                'message' => Str::random(50),
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('name');
    }

    /**
     * In the case of email is not provided in contact form
     */
    public function test_contact_request_should_fail_when_no_email_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('contact.store'), [
                'name'    => $this->faker->name(),
                'phone'   => '+1' . $this->faker->numerify('##########'),
                'budget'  => $this->faker->numberBetween(1, 50),
                'wp_account' => 0,
                'message' => Str::random(50),
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('email');
    }

    /**
     * In the case of phone is not provided in contact form
     */
    public function test_contact_request_should_fail_when_no_phone_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('contact.store'), [
                'name'    => $this->faker->name(),
                'email'   => $this->faker->unique()->safeEmail(),
                'budget'  => $this->faker->numberBetween(1, 50),
                'wp_account' => 0,
                'message' => Str::random(50),
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('phone');
    }

    /**
     * In the case of budget is not provided in contact form
     */
    public function test_contact_request_should_fail_when_no_budget_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('contact.store'), [
                'name'    => $this->faker->name(),
                'email'   => $this->faker->unique()->safeEmail(),
                'phone'   => '+1' . $this->faker->numerify('##########'),
                'wp_account' => 0,
                'message' => Str::random(50),
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('budget');
    }

    /**
     * Submit contact from contact form
     */
    public function test_new_contact_can_register()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('contact.store'), [
                'name'    => $this->faker->name(),
                'email'   => $this->faker->unique()->safeEmail(),
                'phone'   => '+1' . $this->faker->numerify('##########'),
                'budget'  => $this->faker->numberBetween(1, 50),
                'wp_account' => 0,
                'message' => Str::random(50),
            ]);

        $response->assertStatus(
            Response::HTTP_FOUND
        );
    }

    /**
     * Load customer List page
     */
    public function test_customer_list_page_load_successfully()
    {
        $response = $this->actingAs($this->user)->get(route('dashboard.contacts'));
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Create WordPress account
     */
    public function test_wordpress_account_can_create()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('dashboard.account.create'), [
                'id' => $this->customer->id
            ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
