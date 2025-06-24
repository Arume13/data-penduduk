<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KKFactory extends Factory
{
    public function definition()
    {
        return [
            'noKK' => $this->faker->unique()->numerify('#############'),
            'kepalaKeluarga' => $this->faker->name,
            'alamat' => $this->faker->address,
            'rt' => str_pad($this->faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
            'rw' => str_pad($this->faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
            'noRumah' => $this->faker->numberBetween(1, 100),
        ];
    }
}
