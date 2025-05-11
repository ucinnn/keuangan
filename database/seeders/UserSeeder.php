<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>  'admin@gmail.com',
            'username' =>  'admin',
            'password' => Hash::make('admin1234'),
            'role' =>  'admin',
            'no_telp' => '081233416780',
        ]);
        DB::table('users')->insert([
            'name' => 'tupusat',
            'email' =>  'tupusat@gmail.com',
            'username' =>  'tupusat',
            'password' => Hash::make('tupusat1234'),
            'role' =>  'tupusat',
            'no_telp' => '081233416780',
        ]);
        DB::table('users')->insert([
            'name' => 'tuunit',
            'email' =>  'tuunit@gmail.com',
            'username' =>  'tuunit',
            'password' => Hash::make('tuunit1234'),
            'role' =>  'tuunit',
            'no_telp' => '081233416780',
        ]);
    }
}