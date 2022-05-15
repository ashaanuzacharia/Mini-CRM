<?php
namespace Database\Factories;


use App\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
protected $model = Company::class;

public function definition()
    {
        return [
            'name' => $this->faker->name,
            'website' => Str::slug($this->faker->name),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}