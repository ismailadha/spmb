<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sekolah>
 */
class SekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_sekolah' => $this->faker->company().' School',
            'npsn' => $this->faker->unique()->numerify('########'),
            'alamat' => $this->faker->address(),
            'email' => $this->faker->email(),
            'telepon' => $this->faker->phoneNumber(),
            'kode_pos' => $this->faker->postcode(),
            'website' => $this->faker->url(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
