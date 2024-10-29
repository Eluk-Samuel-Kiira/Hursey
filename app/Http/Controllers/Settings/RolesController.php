<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        // return view('roles.role-index',[
        //     'roles' => $roles,
        //     'permissions' => $permissions,
        // ]);

        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'rolePermission':
                return view('roles.role-permission', [
                    'roles' => $roles,
                    'permissions' => $permissions,
                ]);
            default:
                return view('roles.role-index', [
                    'roles' => $roles,
                    'permissions' => $permissions,
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedPermission = $request->validate([
            'permissions' => 'required|array|max:225',  // Ensure permissions is an array
            'permissions.*' => 'exists:permissions,id',  // Validate that each permission exists in the database
            'name' => 'required|string|max:25|unique:roles,name|regex:/^\S+$/',  // Ensure role name is unique
        ]);
        
        $userRole = Role::create([
            'name' => $validatedPermission['name'],
            'guard_name' => 'web'
        ]);
        
        // Retrieve permission names by their IDs
        $permissionNames = Permission::whereIn('id', $validatedPermission['permissions'])->pluck('name');
        $userRole->syncPermissions($permissionNames);
            
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles.created_role'),
                'component' => 'rolePermission',
                'redirect' => route('role.index'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => __('auth.smthin_wrong'),
            ]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $validatedPermission = $request->validate([
            'permissionsEdit' => 'required|array|max:225',  // Ensure permissions is an array
            'permissionsEdit.*' => 'exists:permissions,id',  // Validate that each permission exists in the database
            'role_id' => 'required|string|max:25', // Ensure role name is unique, excluding the current role
        ]);

        
        try {

            // Find the user role by ID and ensure it's not a restricted role
            $userRole = Role::where('name', $id)  // Use the provided ID parameter
                ->whereNotIn('name', ['super_admin', 'admin'])
                ->first();
            
            // If the role exists, sync the permissions
            if ($userRole) {
                $permissions = Permission::whereIn('id', $validatedPermission['permissionsEdit'])->pluck('name');
                $userRole->syncPermissions($permissions);
            } else{
                return response()->json([
                    'success' => false,
                    'message' => __('roles.updated_not'), // General error message
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),  // General error message
            ]);
        }

            // Return a JSON response based on the outcome
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'reload' => true,
                    'message' => __('roles.updated_role'),  // Updated message
                    'component' => 'rolePermission',
                    'redirect' => route('role.index'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.smthin_wrong'),  // General error message
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            // Find the user role by name and ensure it's not a restricted role
            $userRole = Role::where('id', $id)
                ->whereNotIn('name', [
                    'super_admin',
                    'admin',
                    'inventory_manager',
                    'sales_manager',
                    'cashier',
                    'customer_service',
                    'floor_manager',
                    'marketing_manager',
                    'stock_assistant',
                    'supplier_manager',
                    'quality_control',
                ])
                ->first();

            // If the role exists, delete it
            if ($userRole) {
                $userRole->delete();
                
                // Return success response for both AJAX and non-AJAX requests
                return response()->json([
                    'success' => true,
                    'message' => __('roles.deleted_role'),
                    'reload' => true,
                    'component' => 'rolePermission',
                    'redirect' => route('role.index'),
                ]);
            }

            // If role is not found or is restricted, return failure response
            return response()->json([
                'success' => false,
                'message' => __('roles.deleted_not'),
            ]);

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error('Role Deletion Error: ', ['error' => $e->getMessage()]);

            // Return error message as JSON response
            return response()->json([
                'success' => false,
                'message' => __('auth.smthin_wrong'),  // General error message, avoid exposing sensitive details
            ]);
        }
    }

}
