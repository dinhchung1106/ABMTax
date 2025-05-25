<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Create Permissions
        Permission::findOrCreate('create_user');
        Permission::findOrCreate('edit_user');
        Permission::findOrCreate('delete_user');
        Permission::findOrCreate('view_users');

        Permission::findOrCreate('create_post');
        Permission::findOrCreate('edit_post');
        Permission::findOrCreate('delete_post');
        Permission::findOrCreate('view_posts');

        Permission::findOrCreate('create_service');
        Permission::findOrCreate('edit_service');
        Permission::findOrCreate('delete_service');
        Permission::findOrCreate('view_services');

        Permission::findOrCreate('create_course');
        Permission::findOrCreate('edit_course');
        Permission::findOrCreate('delete_course');
        Permission::findOrCreate('view_courses');

        Permission::findOrCreate('create_lesson');
        Permission::findOrCreate('edit_lesson');
        Permission::findOrCreate('delete_lesson');
        Permission::findOrCreate('view_lessons');

        Permission::findOrCreate('approve_collaborator');
        Permission::findOrCreate('reject_collaborator');
        Permission::findOrCreate('reply_contact');
        Permission::findOrCreate('view_company_info');

        Permission::findOrCreate('view_contact');
        Permission::findOrCreate('view_report');
        Permission::findOrCreate('manage_roles_and_permissions');

        // Add Contact permissions
        Permission::findOrCreate('view_contacts');
        Permission::findOrCreate('delete_contacts');

        // Add Company Info permissions
        Permission::findOrCreate('edit_company_info');

        // Add Slider Banner permissions
        Permission::findOrCreate('view_slider_banners');
        Permission::findOrCreate('create_slider_banner');
        Permission::findOrCreate('edit_slider_banner');
        Permission::findOrCreate('delete_slider_banner');

        // Add Category permissions
        Permission::findOrCreate('view_categories');
        Permission::findOrCreate('create_category');
        Permission::findOrCreate('edit_category');
        Permission::findOrCreate('delete_category');

        // Add Tag permissions
        Permission::findOrCreate('view_tags');
        Permission::findOrCreate('create_tag');
        Permission::findOrCreate('edit_tag');
        Permission::findOrCreate('delete_tag');

        // Create Roles and assign existing permissions
        $superAdminRole = Role::findOrCreate('Super Admin');
        $contentManagerRole = Role::findOrCreate('Content Manager');
        $courseManagerRole = Role::findOrCreate('Course Manager');
        $collaboratorManagerRole = Role::findOrCreate('Collaborator Manager');
        $supportStaffRole = Role::findOrCreate('Support Staff');

        // Assign permissions to roles (example)
        $superAdminRole->givePermissionTo(Permission::all()); // Super Admin gets all permissions

        $contentPermissions = [
            'create_post', 'edit_post', 'delete_post',
            'create_service', 'edit_service', 'delete_service',
            // Assuming Content Manager can also manage Company Info (edit)
            'edit_company_info',

            // Add Slider Banner permissions for Content Manager
            'view_slider_banners',
            'create_slider_banner',
            'edit_slider_banner',
            'delete_slider_banner',

            // Add Category permissions for Content Manager
            'view_categories',
            'create_category',
            'edit_category',
            'delete_category',

            // Add Tag permissions for Content Manager
            'view_tags',
            'create_tag',
            'edit_tag',
            'delete_tag',

            // Add Contact permissions for Content Manager
            'view_contacts',
            'delete_contacts',
            'view_company_info',
        ];
        $contentManagerRole->givePermissionTo($contentPermissions);

        $coursePermissions = [
            'create_course', 'edit_course', 'delete_course',
            'create_lesson', 'edit_lesson', 'delete_lesson',
            // Need permissions for managing students/registrations - assuming view_report might cover basic reporting
            'view_report' // Example
        ];
         $courseManagerRole->givePermissionTo($coursePermissions);

        $collaboratorPermissions = [
            'approve_collaborator', 'reject_collaborator',
            'view_contact' // Maybe Collaborator Manager can also view contacts?
        ];
        $collaboratorManagerRole->givePermissionTo($collaboratorPermissions);

        $supportPermissions = [
            'view_contact', 'reply_contact',
            'view_report'
        ];
        $supportStaffRole->givePermissionTo($supportPermissions);

        // Assign a role to a user (example: assign Super Admin to the first user)
        // You would need to adjust this to your user structure/seeder
        // $user = \App\Models\User::find(1);
        // if ($user) {
        //     $user->assignRole('Super Admin');
        // }

        // Assign all permissions to user with email admin@abmtax.com
        $user = \App\Models\User::where('email', 'admin@abmtax.com')->first();
        if ($user) {
            $allPermissions = Permission::pluck('name')->toArray();
            $user->givePermissionTo($allPermissions);
            // Optionally, assign the Super Admin role as well for consistency
            $user->assignRole('Super Admin');
            $this->command->info('Assigned all permissions and Super Admin role to admin@abmtax.com');
        }
    }
}
