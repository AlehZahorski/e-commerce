<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test user registration.
     *
     * @return void
     */
    public function testRegister(): void
    {
        $userService = new UserService();
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add([
            'name' => $this->faker->name,
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);

        $response = $userService->register($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->status());
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
    }

    /**
     * Test user login.
     *
     * @return void
     */
    public function testLogin(): void
    {
        $userService = new UserService();
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add([
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);

        $response = $userService->login($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(Auth::check());
        User::where('email', 'testuser@example.com')->delete();
    }
}
