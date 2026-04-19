<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(['email' => 'admin@kejepret.com'], [
            'name'     => 'Admin KeJepret',
            'email'    => 'admin@kejepret.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // FOTOGRAFER
        User::updateOrCreate(['email' => 'foto@kejepret.com'], [
            'name'     => 'Fotografer Demo',
            'email'    => 'foto@kejepret.com',
            'password' => Hash::make('password123'),
            'role'     => 'photographer',
        ]);

        // RUNNER
        User::updateOrCreate(['email' => 'runner@kejepret.com'], [
            'name'     => 'Runner Demo',
            'email'    => 'runner@kejepret.com',
            'password' => Hash::make('password123'),
            'role'     => 'runner',
        ]);

        $this->command->info('Demo users created!');
        $this->command->info('Admin     : admin@kejepret.com / password123');
        $this->command->info('Fotografer: foto@kejepret.com / password123');
        $this->command->info('Runner    : runner@kejepret.com / password123');
    }
}