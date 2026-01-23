<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all roles
        $superAdmin = Role::where('slug', 'super-admin')->first();
        $admin = Role::where('slug', 'admin')->first();
        $contentManager = Role::where('slug', 'content-manager')->first();
        $editor = Role::where('slug', 'editor')->first();

        // Get all permissions
        $allPermissions = Permission::all();
        $permissionMap = [];
        foreach ($allPermissions as $permission) {
            $permissionMap[$permission->slug] = $permission;
        }

        // Super Admin gets all permissions
        if ($superAdmin) {
            $superAdmin->permissions()->sync($allPermissions->pluck('id'));
        }

        // Admin gets most permissions except user/role management
        if ($admin) {
            $adminPermissions = $allPermissions->filter(function ($permission) {
                return !in_array($permission->slug, ['manage-users', 'view-users', 'manage-roles', 'view-roles']);
            });
            $admin->permissions()->sync($adminPermissions->pluck('id'));
        }

        // Content Manager gets content-related permissions
        if ($contentManager) {
            $contentPermissions = $allPermissions->filter(function ($permission) {
                return in_array($permission->slug, [
                    'manage-pages',
                    'publish-pages',
                    'manage-posts',
                    'publish-posts',
                    'manage-categories',
                    'manage-tags',
                    'manage-galleries',
                    'upload-images',
                    'manage-documents',
                    'upload-documents',
                ]);
            });
            $contentManager->permissions()->sync($contentPermissions->pluck('id'));
        }

        // Editor gets limited permissions (can create/edit but not publish)
        if ($editor) {
            $editorPermissions = $allPermissions->filter(function ($permission) {
                return in_array($permission->slug, [
                    'manage-pages',
                    'manage-posts',
                    'manage-categories',
                    'manage-tags',
                    'manage-galleries',
                    'upload-images',
                    'manage-documents',
                    'upload-documents',
                ]);
            });
            $editor->permissions()->sync($editorPermissions->pluck('id'));
        }
    }
}
