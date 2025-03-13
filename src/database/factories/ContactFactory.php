<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement([1, 2, 3]),
            'email' => $this->faker->unique()->safeEmail,
            'tel_area' => $this->faker->randomElement(['080', '090']), // 例: 090, 080
            'tel_number' => str_pad($this->faker->randomNumber(4, true), 4, '0', STR_PAD_LEFT), // 例: 1234
            'tel_end' => str_pad($this->faker->randomNumber(4, true), 4, '0', STR_PAD_LEFT), // 例: 5678
            'address' => $this->faker->prefecture . '' . $this->faker->city . '' . $this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->realText(50),
        ];
    }
}