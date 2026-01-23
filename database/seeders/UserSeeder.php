<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin User
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@shendamlga.gov.ng'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'), // Change this in production!
                'email_verified_at' => now(),
            ]
        );

        // Assign Super Admin role
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        if ($superAdminRole && !$superAdmin->roles()->where('roles.id', $superAdminRole->id)->exists()) {
            $superAdmin->roles()->attach($superAdminRole->id);
        }

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@shendamlga.local'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'), // Change this in production!
                'email_verified_at' => now(),
            ]
        );

        // Assign Admin role
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole && !$admin->roles()->where('roles.id', $adminRole->id)->exists()) {
            $admin->roles()->attach($adminRole->id);
        }

        // Create Content Manager User
        $contentManager = User::firstOrCreate(
            ['email' => 'content@shendamlga.local'],
            [
                'name' => 'Content Manager',
                'password' => Hash::make('password'), // Change this in production!
                'email_verified_at' => now(),
            ]
        );

        // Assign Content Manager role
        $contentManagerRole = Role::where('slug', 'content-manager')->first();
        if ($contentManagerRole && !$contentManager->roles()->where('roles.id', $contentManagerRole->id)->exists()) {
            $contentManager->roles()->attach($contentManagerRole->id);
        }
    }
}
