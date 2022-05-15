<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('companies')->insert([
                'name' => $this->faker->name,
                'website' => Str::slug($this->faker->name),
                'email' => $this->faker->unique()->safeEmail,
                ]);
        }
    }
}
