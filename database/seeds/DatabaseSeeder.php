<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
           'name' => 'first'
        ]);

        DB::table('product')->insert([
            'name' => 'product'.str_random(10),
            'category_id' => 1,
            'quantity' => rand(1, 10),
            'description' => str_random(100),
            'code' => rand(10, 50),
        ]);
    }
}
