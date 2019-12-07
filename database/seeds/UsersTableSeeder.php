<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        $user = new User();
        $user->name = 'administrador';
        $user->email = 'linux.rlm@gmail.com';
        $user->password = bcrypt('2222');
        $user->save();

        $user = new User();
        $user->name = 'Jovenita';
        $user->email = 'jovenita@fimatec.com.br';
        $user->password = bcrypt('1234');
        $user->save();

        $user = new User();
        $user->name = 'Elizabeth';
        $user->email = 'elizabeth@fimatec.com.br';
        $user->password = bcrypt('1234');
        $user->save();
    }
}
