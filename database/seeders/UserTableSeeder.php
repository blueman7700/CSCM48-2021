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
        // 
        // $u = new User;
        // $u->name = "SuperUser";
        // $u->email = "SuperUser@TestEmail.com";
        // $u->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        // $u->date_created = date('Y-m-d H-i-s');
        // $u->image = null;
        // $u->email_verified_at = null;
        // $u->save();

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
