<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Subject;
use http\Env\Response;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();

        return response()->json([
                'status' => true,
                'data' => $subjects,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request data
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'professor_id' => 'required|integer',
            'department_id' => 'required|integer',
            'level_id' => 'required|integer',

        ]);
        //create a new subject
        $subject = Subject::create($validateData);
        $subject->save();

        return response()->json([
            'status' => true,
            'message' => 'Subject added successfully',
            'data' => $subject,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::find($id);
        if (!$subject){
            return response()->json([
                'status' => false,
                'massage' => 'Subject not found'
            ],404);
        }
        return response()->json([
           'status' => true,
           'data' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, string $id)
//    {
//        //validate the request data
//        $validatedData = $request->validate([
//            'name' => 'required|max:255',
//            'professor_id' => 'required|integer',
//            'department_id' => 'required|integer',
//            'level_id' => 'required|integer',
//        ]);
//
//        $subject = Subject::find($id);
//        $subject->save();
//
//        if (!$subject){
//            return response()->json([
//                'status' => false,
//                'massage' => 'Subject not found'
//            ],404);
//        }
//        return response()->json([
//            'status' => true,
//            'message' => 'Subject update successfully',
//            'data' => $subject,
//        ]);
//    }

    public function update(Request $request, $id)
    {
        if(Subject::where('id', $id)->exists())
        {
            $subject = Subject::findOrFail($id);
            $subject->name = $request->input('name');
            $subject->level_id = $request->input('level_id');
            $subject->department_id = $request->input('department_id');
            $subject->professor_id = $request->input('professor_id');

            $subject->save();

            return response()->json([
                'status' => true,
                "message" => "subject updated successfully",
                'data' => $subject,
            ], 200);

        }
        else
        {
            return response()->json([
                "message" => "subject not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json([
            'massage' => 'subject deleted successfully',
        ]);
    }
}
