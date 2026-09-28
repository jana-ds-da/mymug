<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\DataTables\DepartmentDataTable;

class DepartmentController extends Controller
{
      public function index(DepartmentDataTable $dataTable)
    {
        return $dataTable->render('departments.index');
    }
 
       // create function
      public function create()
    {
       return view('departments.form');
    }

         // store function
       public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'status' => 'required|boolean',
        ]);

        Department::create($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

        // edit function
      public function edit(Department $department)
    {
        return view('departments.form', compact('department'));
    }

          // update function
       public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'status' => 'required|boolean',
        ]);

        $department->update($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

            // destroy function
     public function destroy(Department $department)
    {
        if ($department->users()->exists()) {
            return redirect()
                ->route('departments.index')
                ->with('error', 'Cannot delete this department because it has users assigned to it.');
        }

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
