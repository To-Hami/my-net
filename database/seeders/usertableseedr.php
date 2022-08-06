<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class usertableseedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('password')
        ]);

//        $user->attachRole('super_admin');

    }
}
