<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $learners = Learner::all();
        return view('learners.index', [
            'learners' => $learners
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = ['Beginner','Intermediate','Advanced'];
        return view('learners.create', compact('levels'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newLearner = Learner::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'level' => $request->level
        ]);

        return redirect('/learners/' . $newLearner->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $learner = Learner::find($id);

        return view('learners.show', [
            'learner' => $learner,
         
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $learner = Learner::find($id);
        $levels = ['Beginner','Intermediate','Advanced'];
        
        
        return view('learners.edit', compact('learner', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $learner = Learner::find($id);
       

        $learner->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'level' => $request->level
        ]);


        return redirect('/learners');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Learner $learner)
    {
        $learner->delete();
        return redirect('/learners');
    }
}
