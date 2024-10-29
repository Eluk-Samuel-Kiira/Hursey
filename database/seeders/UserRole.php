<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_roles = [
            'super_admin',            // Full access to all system features and settings
            'admin',                  // General administrative roles with access to most features
            'inventory_manager',      // Manages clothing items, stock, and inventory
            'sales_manager',          // Oversees sales operations and customer relations
            'cashier',                // Handles sales transactions and payments
            'customer_service',       // Manages customer inquiries, complaints, and interactions
            'floor_manager',          // Manages boutique floor operations, ensuring customer satisfaction
            'marketing_manager',      // Manages marketing campaigns, promotions, and customer outreach
            'stock_assistant',        // Helps manage stock and inventory restocking
            'supplier_manager',       // Oversees relationships and orders with clothing suppliers
            'quality_control',        // Ensures clothing quality and customer satisfaction
        ];
        
        
        foreach ($all_roles as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = [
            // Customer Management
            'create customer',
            'view customer',
            'edit customer',
            'delete customer',
            'update customer',
            'manage customer communications',
        
            // Inventory Management
            'create inventory',
            'view inventory',
            'edit inventory',
            'delete inventory',
            'update inventory',
            'order clothing items',
            'receive clothing items',
            'manage stock levels',
            'view stock reports',
        
            // Sales Management
            'create sales transaction',
            'view sales',
            'edit sales',
            'delete sales',
            'process returns',
            'view sales reports',
        
            // Supplier Management
            'create supplier',
            'view supplier',
            'edit supplier',
            'delete supplier',
            'update supplier',
        
            // Marketing Management
            'create marketing campaign',
            'view marketing campaigns',
            'edit marketing campaign',
            'delete marketing campaign',
            'run promotions',
            'manage social media ads',
        
            // User Management
            'create user',
            'view user',
            'edit user',
            'delete user',
            'update user',
            'manage roles and permissions',
        
            // System Logs and Auditing
            'view system logs',
            'audit actions',
        
            // Financial Management
            'view financial reports',
            'manage payments',
            'view transaction history',
            'process refunds',
        
            // Super Admin Permissions
            'super_admin only',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //Give admin all the permissions
        $adminRole = Role::where(['name' => 'super_admin'])->first();
        $permissions = Permission::all(); 
        $adminRole->syncPermissions($permissions);

        $admin = Role::where(['name' => 'admin'])->first();
        $admin->syncPermissions($permissions);

        // Samuel
        $adminUser = User::factory()->create([
            'name' => 'Samuel Edu',
            'phone_number' => '0754428612',
            'role' => 'super_admin',
            'status' => 'active',
            'email' => 'samuelkiiraeluk@gmail.com',
            'password' => bcrypt('1234567890')
        ]);
        $adminUser->assignRole('super_admin');


        // Brian
        $adminUser = User::factory()->create([
            'name' => 'St Brian',
            'phone_number' => '0760415446',
            'role' => 'super_admin',
            'status' => 'active',
            'email' => 'timbrian57@gmail.com',
            'password' => bcrypt('1234567890')
        ]);
        $adminUser->assignRole('super_admin');

        // info
        $adminUser = User::factory()->create([
            'name' => 'Admin hursey',
            'phone_number' => '0392001682',
            'role' => 'super_admin',
            'status' => 'active',
            'email' => 'info@hursey.co.ug',
            'password' => bcrypt('1234567890')
        ]);
        $adminUser->assignRole('super_admin');

    }
}
