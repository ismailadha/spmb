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

test('auth user can store a new user', function () {
    $admin = User::factory()->create(['role' => 'admin_dinas']);
    $userData = [
        'name' => 'New User Test',
        'nik' => '1234567890123456',
        'username' => 'newusertest',
        'password' => 'password123',
        'role' => 'peserta',
    ];

    $response = $this->actingAs($admin)->post(route('pengguna.store'), $userData);

    $response->assertRedirect(route('pengguna.index'));
    $response->assertSessionHas('success', 'Data pengguna berhasil ditambahkan.');

    $this->assertDatabaseHas('users', [
        'name' => 'New User Test',
        'nik' => '1234567890123456',
        'username' => 'newusertest',
        'role' => 'peserta',
    ]);
});
