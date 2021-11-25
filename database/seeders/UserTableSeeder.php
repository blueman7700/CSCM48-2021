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
            $attempts = random_int(0, $num_users);
            for($i=0; $i<$attempts; $i++) {
                $friend = User::all()->except($user->id)->random();
                $exists = $user->Following->contains($friend);

                if(!$exists) {
                    $user->following()->attach($friend);
                }
            }
        }
    }
}

