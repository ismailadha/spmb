<?php

use App\Models\User;

test('auth user can view the user list page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('pengguna.index'));

    $response->assertStatus(200);
    $response->assertSee('Data Pengguna');
    $response->assertSee('Tambah Pengguna');
    $response->assertSee($user->name);
});
