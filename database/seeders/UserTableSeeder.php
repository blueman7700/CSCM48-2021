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
            $users_to_follow = User::all()->random(random_int(0, User::all()->count()));
            foreach($users_to_follow as $to_follow) {
                if($to_follow->id != $user->id) {
                    $user->following()->attach($to_follow->id);
                }
            }
        }
    }
}

