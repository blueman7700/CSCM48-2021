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
        $u = new User;
        $u->name = "SuperUser";
        $u->email = "SuperUser@TestEmail.com";
        $u->password = "testpassword";
        $u->date_created = date('Y-m-d H-i-s');
        $u->image = null;
        $u->email_verified_at = null;
        $u->save();
    }
}
