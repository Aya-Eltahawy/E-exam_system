<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapter = Chapter::all();
        return response()->json(['data' => $chapter]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
           'name' => 'required|max:255',
           'subject_id' => 'required|integer',
           'num_of_questions' => 'required|integer',
        ]);

        $chapter = Chapter::create($validateData);
        $chapter->save();
        return response()->json([
            'status' => true,
            'massage' => 'chapter created successfully',
            'data' => $chapter,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        $chapter = Chapter::findOrFail($id);
//        return response()->json(['data' => $chapter]);

        $chapter = Chapter::find($id);
        if (!$chapter){
            return response()->json([
                'status' => false,
                'massage' => 'chapter not found'
            ],404);
        }
        return response()->json([
            'status' => true,
            'data' => $chapter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Chapter::where('id', $id)->exists())
        {
            $chapter = Chapter::findOrFail($id);
            $chapter->name = $request->input('name');
            $chapter->subject_id = $request->input('subject_id');
            $chapter->num_of_questions = $request->input('num_of_questions');

            $chapter->save();

            return response()->json([
                'status' => true,
                "message" => "chapter updated successfully",
                'data' => $chapter,
            ], 200);

        }
        else
        {
            return response()->json([
                "message" => "chapter not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {

        $chapter->delete();

        return response()->json([
            'massage' => 'chapter deleted successfully',
        ]);
    }
}
