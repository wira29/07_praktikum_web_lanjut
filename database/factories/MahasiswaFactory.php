<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nim' => '0',
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'kelas_id' => '1',
            'jurusan' => 'Teknologi Informasi',
            'no_handphone' => fake()->phoneNumber(),
            'tanggal_lahir' => fake()->date()
        ];
    }
}
