<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use App\DataTables\UsersDataTable;
use App\Models\Department;


class UserController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {  
       
       return $dataTable->render('users.index');
    }

      // data function
    public function data()
    {
        $users = User::query();

        return DataTables::of($users)
          ->addIndexColumn()
          ->make(true);
    }
    
       // create function
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('users.create', compact('roles'));
    }
    
        // store function
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:8'
            ],

            'role' => [
                'required',
                'exists:roles,name'
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $user->assignRole($validated['role']);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }
           
          // edit function
        public function edit(User $user)
        {
             $roles = Role::orderBy('name')->get();
             $departments = Department::where('status', 1)->get();

             return view('users.edit', compact('user', 'roles', 'departments'));
        }
        
            //update  function
       public function update(Request $request, User $user)
      {
           $validated = $request->validate([
              'name' => ['required', 'string', 'max:255'],
              'email' => [
                 'required',
                 'email',
                 'max:255',
                 'unique:users,email,' . $user->id,
            ],
             'role' => ['required', 'exists:roles,name'],
              'department_id' => ['required', 'exists:departments,id'],
            
        ]);

         $user->update([
            'name' => $validated['name'],
             'email' => $validated['email'],
             'department_id' => $validated['department_id'],
        ]);

         $user->syncRoles([$validated['role']]);

           return response()->json([
             'success' => true,
             'message' => 'User updated successfully.',
        ]);
      }
       
     
        // destroy function
       public function destroy(User $user)
     {  
          $user->delete();

         return response()->json([
           'success' => true,
           'message' => 'User deleted successfully.'
       ]);
     }

}
