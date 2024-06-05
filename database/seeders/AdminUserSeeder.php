<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        (new User)->create([
            'name' => 'Admin',
            'email' => 'admin@codias.com',
            'password' => Hash::make('12345678'), // Cambia 'password' por una contraseña segura
            'is_admin' => true, // Suponiendo que tienes un campo is_admin en tu tabla users
        ]);
    }
}
