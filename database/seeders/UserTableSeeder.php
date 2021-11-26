<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = User::factory()->count(10)->create();

        $num_users = User::all()->count();

        foreach($users as $user)
        {
            $friend = User::all()->random();
            if($friend->id != $user->id) {
                $user->following()->attach($friend);
            }
        }
    }
}

