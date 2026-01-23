<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User Management
            ['name' => 'Manage Users', 'slug' => 'manage-users', 'description' => 'Create, edit, and delete users'],
            ['name' => 'View Users', 'slug' => 'view-users', 'description' => 'View user list and details'],
            
            // Role Management
            ['name' => 'Manage Roles', 'slug' => 'manage-roles', 'description' => 'Create, edit, and delete roles'],
            ['name' => 'View Roles', 'slug' => 'view-roles', 'description' => 'View roles and permissions'],
            
            // Page Management
            ['name' => 'Manage Pages', 'slug' => 'manage-pages', 'description' => 'Create, edit, and delete pages'],
            ['name' => 'Publish Pages', 'slug' => 'publish-pages', 'description' => 'Publish and unpublish pages'],
            
            // Post Management
            ['name' => 'Manage Posts', 'slug' => 'manage-posts', 'description' => 'Create, edit, and delete posts'],
            ['name' => 'Publish Posts', 'slug' => 'publish-posts', 'description' => 'Publish and unpublish posts'],
            
            // Category & Tag Management
            ['name' => 'Manage Categories', 'slug' => 'manage-categories', 'description' => 'Create, edit, and delete categories'],
            ['name' => 'Manage Tags', 'slug' => 'manage-tags', 'description' => 'Create, edit, and delete tags'],
            
            // Gallery Management
            ['name' => 'Manage Galleries', 'slug' => 'manage-galleries', 'description' => 'Create, edit, and delete galleries'],
            ['name' => 'Upload Images', 'slug' => 'upload-images', 'description' => 'Upload images to galleries'],
            
            // Document Management
            ['name' => 'Manage Documents', 'slug' => 'manage-documents', 'description' => 'Create, edit, and delete documents'],
            ['name' => 'Upload Documents', 'slug' => 'upload-documents', 'description' => 'Upload document files'],
            
            // Settings
            ['name' => 'Manage Settings', 'slug' => 'manage-settings', 'description' => 'Update system settings'],
            
            // Logs
            ['name' => 'View Activity Logs', 'slug' => 'view-activity-logs', 'description' => 'View activity logs'],
            ['name' => 'View Access Logs', 'slug' => 'view-access-logs', 'description' => 'View access logs'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
