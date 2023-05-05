<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return response()->json([
            'status' => true,
            'data' => $questions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
           'content'=>'required',
           'correct_answer'=>'required',
           'difficulty_level'=>'required|integer|min:1|max:5',
            'chapter_id'=>'required|integer|exists:chapters,id',
            'question_type'=>'required',
            'subject_id'=>'required|integer|exists:subjects,id',
            'is_training'=>'boolean',
        ]);

        $question = Question::create($validateData);
        $question->save();
        return response()->json([
            'status' => true,
            'message' => 'question added successfully',
            'data' => $question,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::find($id);
        if (!$question){
            return response()->json([
                'status' => false,
                'massage' => 'question not found'
            ],404);
        }
        return response()->json([
            'status' => true,
            'data' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Question::where('id', $id)->exists())
        {
            $question = Question::findOrFail($id);
            $question->content = $request->input('content');
            $question->correct_answer = $request->input('correct_answer');
            $question->difficulty_level = $request->input('difficulty_level');
            $question->chapter_id = $request->input('chapter_id');
            $question->question_type = $request->input('question_type');
            $question->subject_id = $request->input('subject_id');
            $question->is_training = $request->input('is_training');


            $question->save();

            return response()->json([
                'status' => true,
                "message" => "Question updated successfully",
                'data' => $question,
            ], 200);

        }
        else
        {
            return response()->json([
                "message" => "Question not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json([
            'message' => 'Question deleted successfully',
            ]);
    }
}
