<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sentence $sentence)
    {

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'sentence_id' => 'required',
            //'learner_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $comment = Comment::create([
            'body' => $request->body,
            'sentence_id' => $request->sentence_id,
            'learner_id' => Auth::guard('learners')->user()->id
        ]);

        return response()->json([
            'Comment saved'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Comment::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function update(Request $request, $id)
    {
       
         $comment = Comment::find($id);

        if($comment->learner_id == Auth::guard('learners')->user()->id){
        $comment->update($request->all());
       
        return response()->json([
            'Success - Comment updated.',
             $comment
        ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if($comment->learner_id == Auth::guard('learners')->user()->id){
        $comment->delete();
        return response()->json('Success  - Comment deleted.');
    }else{
        return "Unauthorized.";
    }
}

    public function getUserComments()
    {
        $user = Auth::user();
        $comments = DB::table('comments')
                    ->where('learner_id', $user->id)
                    ->get();

        return $comments;

    }
}