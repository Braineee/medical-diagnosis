<?php

namespace App\Http\Controllers;

use App\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get the list of symptoms
        $symptoms = Symptom::all();
        return view('symptoms.index', ['symptoms' => $symptoms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('symptoms.create');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'symptom' => ['required', 'string', 'max:255'],
            'symptom_description' => ['required', 'string', 'max:191']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $symptom_created = Symptom::create([
          'symptom_name' => $request->input('symptom'),
          'description' => $request->input('symptom_description')
      ]);
      //check if storage was successful
      if($symptom_created){
        return redirect()->route('symptoms.index')->with('success','Symptom has been registered successfully');
      }else{
          return back()->withInput()->with('error','Sorry, Symptom was not registered');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
      //$project = Project::where('id', $project->id)->first();
      $symptom = Symptom::find($symptom->disease_id);

      //pass the project comments to the comments variable
      //$symptoms = $symptom->symptoms;

      return view('symptoms.show', ['symptoms' => $symptom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
      $findSymptom = Symptom::find($symptom->disease_id);

      if($findSymptom->delete()){
          return redirect()->route('symptoms.index')->with('success', 'Symptom has been deleted successfully');
      }
      //redirect
      return back()->withInput('error', 'Symptom could not be deleted');
    }
}
