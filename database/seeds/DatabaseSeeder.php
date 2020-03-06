<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Defult Login
        DB::table('users')->insert([
            'name'     => 'IRIDIUM',
            'username' => 'iridium',
            'email'    => 'iridium@localhost',
            'password' => bcrypt('iridium')
        ]);    }
}
