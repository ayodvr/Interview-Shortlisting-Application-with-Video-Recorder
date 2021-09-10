<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =  \App\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone'=>   '08033322345',
            'uuid'=>    uniqid(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin->assignRole('admin');

        $admin = \App\User::create([
            'name' => 'client',
            'email' => 'client@gmail.com',
            'phone'=>   '08033322345',
            'uuid'=>    uniqid(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin->assignRole('client');

        $admin = \App\User::create([
            'name' => 'candidate',
            'email' => 'candidate@gmail.com',
            'phone'=>   '08033322345',
            'uuid'=>    uniqid(),
            'group_id'=>    '1',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin->assignRole('candidate');
    }
}
