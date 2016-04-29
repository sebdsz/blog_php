<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\User::class, 3)->create();

        \App\User::create([
            'name' => 'Niir',
            'password' => \Illuminate\Support\Facades\Hash::make('passpass'),
            'role' => 'administrator'
        ]);
    }
}
