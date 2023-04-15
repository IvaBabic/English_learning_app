<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Route;

class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $sentences = Sentence::all();
        return view('sentences.index', [
            'sentences' => $sentences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = ['Beginner','Intermediate','Advanced'];
        return view('sentences.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $newSentence = Sentence::create([
            'body' => $request->body,
            'level' => $request->level
        ]);

        return redirect('/sentences/' . $newSentence->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($sentenceid)
    {
        $sentence = Sentence::find($sentenceid);

        return view('sentences.show', [
            'sentence' => $sentence,
         
        ]);
         
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sentenceid)
    {
        $sentence = Sentence::find($sentenceid);
        $levels = ['Beginner','Intermediate','Advanced'];
        //return view('sentences.create', compact('levels'));

        // return view('sentences.edit', [
        //         'sentence' => $sentence,
        //         'levels' =>$levels
        //     ]);
        
        return view('sentences.edit', compact('sentence', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sentenceid)
    {
        $sentence = Sentence::find($sentenceid);
       

        $sentence->update([
            'body' => $request->body,
            'level' => $request->level
        ]);


        return redirect('/sentences')->with('success', 'Sentence Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sentenceid)
    {
        $sentence = Sentence::find($sentenceid);
        
            $sentence->delete();


        return redirect('/sentences');
    }
}
