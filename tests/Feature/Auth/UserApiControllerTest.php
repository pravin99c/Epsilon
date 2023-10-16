<?php

use App\Models\User;
use Illuminate\Support\Str;


it('has a welcome page', function () {
    // dd(env('APP_ENV'));
    User::factory()->create();
    $this->get('/')->assertStatus(200);
});

/* it('has a registration page', function () {
    $data = [
        "name" => "test",
        "email" => Str::random(5)."@gmail.com",
        "password" => "12345678",
        "password_confirmation" => "12345678"
    ];

    $this->post('/register', $data)->assertStatus(200);

    $this->assertDatabaseHas('users', $data);
});
 */
