<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@abmtax.com',
            'password' => Hash::make('admin123'),
            'phone' => '0123456789',
            'address' => '123 Đường ABC, Quận XYZ, TP.HCM',
            'date_of_birth' => '1990-01-01',
            'image' => 'uploads/users/default-avatar.png'
        ]);
        $superAdmin->assignRole('Super Admin');

        // Create Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin2@abmtax.com',
            'password' => Hash::make('admin123'),
            'phone' => '0987654321',
            'address' => '456 Đường DEF, Quận UVW, TP.HCM',
            'date_of_birth' => '1992-05-15',
            'image' => 'uploads/users/default-avatar.png'
        ]);
        $admin->assignRole('Admin');

        // Create Editor
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@abmtax.com',
            'password' => Hash::make('editor123'),
            'phone' => '0369852147',
            'address' => '789 Đường GHI, Quận RST, TP.HCM',
            'date_of_birth' => '1995-08-20',
            'image' => 'uploads/users/default-avatar.png'
        ]);
        $editor->assignRole('Editor');

        // Create User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@abmtax.com',
            'password' => Hash::make('user123'),
            'phone' => '0589632147',
            'address' => '321 Đường JKL, Quận MNO, TP.HCM',
            'date_of_birth' => '1998-12-25',
            'image' => 'uploads/users/default-avatar.png'
        ]);
        $user->assignRole('User');
    }
}
