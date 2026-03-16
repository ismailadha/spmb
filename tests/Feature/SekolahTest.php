<?php

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can view sekolah index', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('sekolah.index'));

    $response->assertStatus(200);
});

test('user can create sekolah', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('sekolah.create'));

    $response->assertStatus(200);
});

test('user can store sekolah', function () {
    $user = User::factory()->create();

    $sekolahData = [
        'nama_sekolah' => 'Sekolah Test',
        'npsn' => '12345678',
        'alamat' => 'Jl. Test No. 1',
        'email' => 'test@sekolah.com',
        'telepon' => '08123456789',
    ];

    $response = $this->actingAs($user)->post(route('sekolah.store'), $sekolahData);

    $response->assertRedirect(route('sekolah.index'));
    $this->assertDatabaseHas('sekolah', $sekolahData);
});

test('user can view sekolah detail', function () {
    $user = User::factory()->create();
    $sekolah = Sekolah::factory()->create();

    $response = $this->actingAs($user)->get(route('sekolah.show', $sekolah));

    $response->assertStatus(200);
    $response->assertSee($sekolah->nama_sekolah);
});
