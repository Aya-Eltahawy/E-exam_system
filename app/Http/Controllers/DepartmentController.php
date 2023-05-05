<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return response()->json([
            'data' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:departments',
        ]);

        $department = Department::create($validateData);
        return response()->json([
            'message' => 'Dept created successfully',
            'data' => $department,
        ]);
    }

    public function show(Department $department)
    {
        return response()->json([
            'data' => $department
        ]);
    }

//    public function update(Request $request, Department $department)
//    {
//        $validateData = $request->validate([
//            'name' => 'required|unique:departments'
//        ]);
//        $department->update($validateData);
//        return response()->json([
//            'status' => true,
//            'massage' => 'Department updated successfully',
//            'data' => $department,
//        ]);
//    }

//
    public function update(Request $request, $id)
    {
        if(Department::where('id', $id)->exists())
        {
            $department = Department::findOrFail($id);
            $department->name = $request->input('name');

            $department->save();

            return response()->json([
                'status' => true,
                "message" => "department updated successfully",
                'data' => $department,
            ], 200);

        }
        else
        {
            return response()->json([
                "message" => "department not found"
            ], 404);
        }
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'massage' => 'Department deleted successfully',
        ]);
    }
}
