<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'id' => (string) Str ::orderedUuid(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => rand(20, 45),
            'attribute' => rand(0, 1),
            'tel' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'comment' => $this->faker->realText(),
            'password' => Hash::make($this->faker->password()),
            'family_id' => Str::orderedUuid(),
            'remember_token' => Str::random(10),
        ];
    }
}
