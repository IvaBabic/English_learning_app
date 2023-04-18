<?php


namespace App\Http\Controllers\API;

use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Learner::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'status' => [new Enum(ServerStatus::class)],
        ]);

        return Learner::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Learner::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
    if(Auth::getDefaultDriver() == 'admin'){

        $learner = Learner::find($id);
        $learner->update($request->all());
        return $learner;

    }elseif(Auth::getDefaultDriver() == 'learners'){
         if($id == Auth::guard('learners')->user()->id){
        $learner = Learner::find($id);
        $learner->update($request->all());
        return $learner;
         }else{
            return "Unauthorized.";
         }
    }
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::getDefaultDriver() == 'admin'){

            Learner::destroy($id);
            return response()->json('Learner deleted.');
    
        }elseif(Auth::getDefaultDriver() == 'learners'){
             if($id == Auth::guard('learners')->user()->id){
                Learner::destroy($id);
                return response()->json('Learner deleted.');
             }else{
                return "Unauthorized.";
             }
        }
       
    }

    public function search($name)
    {
        return Learner::where('first_name', 'like', '%'.$name.'%')->get();
    }
}
