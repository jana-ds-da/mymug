<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\RolesDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
      public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('roles.index');
    }

         // create function
       public function create()
    {
          $permissions = Permission::orderBy('name')->get();

           return view('roles.create', compact('permissions'));
    }   
     
          // store function
     public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'exists:permissions,id',
            ],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
        ]);

        $permissions = Permission::whereIn(
            'id',
            $validated['permissions'] ?? []
        )->get();

        $role->syncPermissions($permissions);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }
         
          // edit function
       public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();

        $rolePermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('roles.create', compact(
            'role',
            'permissions',
            'rolePermissions'
        ));
    }

         // update function
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name,' . $role->id,
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        $role->update([
            'name' => $validated['name'],
        ]);

         $permissionIds = $validated['permissions'] ?? [];

         $permissions = Permission::whereIn('id', $permissionIds)->get();

          $role->syncPermissions($permissions);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }
  
       // destroy function
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully.',
        ]);
    }
}
