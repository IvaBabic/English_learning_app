<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sentence::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'status' => [new Enum(ServerStatus::class)],
        ]);

        return response()->json([
            'Success - Sentence saved.',
            Sentence::create($request->all())
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Sentence $sentence)
    {
        return Sentence::find($sentence);
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function update(Request $request,  $id)
    {
        $sentence = Sentence::find($id);
        $sentence->update($request->all());
       
        return response()->json([
            'Success - Sentence updated.',
             $sentence
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentence $id)
    {
            $sentence = Sentence::find($id);
            $sentence[0]->delete();
            return response()->json('Success  - Sentence deleted.');
    }

    public function search($name)
    {
        return Sentence::where('body', 'like', '%'.$name.'%')->get();
    }

    public function UserLevelSentence(){
        
        $user = Auth::user();

        $sentences = DB::table('sentences')
                    ->where('level', $user->level)
                    ->get();

        return $sentences;
    }
}
