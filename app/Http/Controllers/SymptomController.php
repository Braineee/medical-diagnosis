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
            'symptom_description' => ['required', 'string', 'max:225']
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
      $symptom = Symptom::find($symptom->symptom_id);

      return view('symptoms.show', ['symptom' => $symptom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit(Symptom $symptom)
    {
      $symptom = Symptom::find($symptom->symptom_id);

      return view('symptoms.edit', ['symptom' => $symptom]);
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
      $updateSymptom = Symptom::where('symptom_id', $symptom->symptom_id)->update([
        'symptom_name' => $request->input('symptom'),
        'description' => $request->input('symptom_description')
      ]);

      if($updateSymptom){
          return redirect()->route('symptoms.index')->with('success', 'Symptom was updated successfully');
      }
      //redirect
      return back()->withInput('error', 'Symptom could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
      $findSymptom = Symptom::find($symptom->symptom_id);

      if($findSymptom->delete()){
          return redirect()->route('symptoms.index')->with('success', 'Symptom has been deleted successfully');
      }
      //redirect
      return back()->withInput('error', 'Symptom could not be deleted');
    }
}
