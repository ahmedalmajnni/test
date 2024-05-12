<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionTableSeeder extends Seeder
{

    private $permissions = [
        'Invoices',
        'Invoice List',
            'Add Invoice',
            'Delete Invoice',
            'Export to EXCEL',
            'Change Payment Status',
            'Edit Invoice',
            'Archive Invoice',
            'Print Invoice',
            'Add Attachment',
            'Delete Attachment',

        'Paid Invoices',
        'Partially Paid Invoices',
        'Unpaid Invoices',
        'Invoices Archive',


        'Reports',
        'Invoice Report',
        'Customer Report',


        'Users',
        'User List',
            'Add User',
            'Edit User',
            'Delete User',

        'User Permissions',
            'View Permission',
            'Add Permission',
            'Edit Permission',
            'Delete Permission',


        'Settings',

        'Products',
            'Add Product',
            'Edit Product',
            'Delete Product',

        'Sections',
            'Add Section',
            'Edit Section',
            'Delete Section',

        'Notifications',
    ];





    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            ModelsPermission::create(['name' => $permission]);
        }
    }
}
