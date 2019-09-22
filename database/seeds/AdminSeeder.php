<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'kode_role' => 'admin',
            'nama' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
