<?php

namespace Tests\Feature\Controllers\API\V1;

use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\RegisterController
     */
    public function register_is_successful()
    {
        $email = $this->faker->safeEmail();
        $password = $this->faker->password(8);

        $response = $this->postJson('/api/register', [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['token']);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    /**
     * @test
     * @see \App\Http\Requests\API\V1\RegisterRequest
     */
    public function register_request_is_validated()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'email',
            'password',
        ]);
    }

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\RegisterController
     */
    public function error_is_handled()
    {
        $mock = $this->createMock(UserService::class);
        $mock->method('registerUser')->will($this->returnSelf());
        $mock->method('hasError')->willReturn(true);
        $mock->method('getError')->willReturn('Something went wrong');

        $this->app->instance(UserService::class, $mock);

        $email = $this->faker->safeEmail();
        $password = $this->faker->password(8);

        $response = $this->postJson('/api/register', [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
}
