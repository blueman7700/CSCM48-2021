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

        foreach($users as $user)
        {
            $friend = User::find(rand(1, 10));
            if($user->id != $friend->id) {
                $user->followers()->attach($friend);
            }
        }

    }
}

