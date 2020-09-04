<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = [
            'name' => 'andre',
            'username' => 'andre',
            // 'nik' => null,
            'phone' => '082349142532',
            'address' => 'kesiman',
            'email' => 'andre@gmail.com',
            'gender' => 1,
            'password' => bcrypt('123456')
        ];
        $admin = [
            'name' => 'yogi',
            'username' => 'yogi',
            // 'nik' => null,
            'phone' => '082349142532',
            'address' => 'kesiman',
            'email' => 'yogi@gmail.com',
            'gender' => 1,
            'password' => bcrypt('123456')
        ];

        $sa =  \App\User::create($superadmin);
        $sa->assignRole('superadmin');

        $a =  \App\User::create($admin);
        $a->assignRole('admin');
    }
}
