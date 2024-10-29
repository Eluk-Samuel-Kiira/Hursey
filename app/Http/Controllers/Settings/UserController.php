<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::all();
        // return view('users.user-index', [
        //     'users' => $users,
        //     'roles' => $roles,
        // ]);

        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'userIndexTable':
                return view('users.users-comp', [
                    'users' => $users,
                    'roles' => $roles,
                ]);
            default:
                return view('users.user-index', [
                    'users' => $users,
                    'roles' => $roles,
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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => 'required|regex:/^[0-9]{10,15}$/',
            'role' => 'required|string|exists:roles,name',
            'status' => 'nullable|in:active,inactive',
        ]);
    
        // Log validated data for debugging
        // \Log::info($validatedData);
        $password ='1234567890';
        $validatedData['password'] = Hash::make($password);
        $user = User::create($validatedData);
        $user->assignRole($request->role);

        event(new Registered($user));

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles._user_created'),
                'component' => 'userIndexTable',
                'redirect' => route('user.index'),
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
        $validatedData = $request->validate([
            'edit_name' => ['required', 'string', 'max:255'],
            'edit_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'edit_phone_number' => 'required|regex:/^[0-9]{10,15}$/',
            'edit_role' => 'required|string|exists:roles,name',
            'edit_status' => 'nullable|in:active,inactive',
        ]);

        $user = User::find($id);

        if ($user && !in_array($user->role, ['super_admin', 'admin'])) {
            // User found and does not have the specified roles
            $user->update([
                'name' => $validatedData['edit_name'],
                'email' => $validatedData['edit_email'],
                'phone_number' => $validatedData['edit_phone_number'],
                'role' => $validatedData['edit_role'],
                'status' => $validatedData['edit_status'],
            ]);
            
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles._user_edited'),
                'component' => 'userIndexTable',
                'redirect' => route('user.index'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('roles._user_edited_not'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user && !in_array($user->role, ['super_admin', 'admin'])) { 
            $user->delete();
            
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles._user_deleted'),
                'component' => 'userIndexTable',
                'redirect' => route('user.index'),
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => __('roles._user_edited_not'),
        ]);
        
    }
}
