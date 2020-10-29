<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationSeeder::class);

        User::create([
            'name' => 'Geruth Ganteng',
            'email' => 'geruth@ganteng.com',
            'instance' => 'AKMIL',
            'password' => Hash::make('123123'),
            'role' => '1'
        ]);

        $this->call(PersonSeeder::class);
    }
}
