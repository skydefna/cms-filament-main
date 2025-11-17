<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class USerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'Super Admin',
            'email' => config('app.super_admin'),
            'password' => Hash::make('supmin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Admin',
            'email' => config('app.admin'),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);
    }
}
