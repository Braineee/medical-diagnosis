<?php

namespace App\Http\Controllers;

use DB;
use App\Disease;
use App\Level;
use App\Symptom;
use App\DiseaseSymptom;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the list of patients
        $diseases = Disease::all();
        return view('diseases.index', ['diseases' => $diseases]);
    }

    /**
      * show the form for adding symptoms to diseases
      */
    public function addSymptom( $disease_id = null )
    {
      if(!$disease_id){
        return back();
      }
      // get the disease details
      $disease = Disease::find($disease_id);

      $symptoms = Symptom::all();

      $levels = Level::all();


      return view('diseases.addsymptom', ['disease' => $disease, 'symptoms' => $symptoms, 'levels' =>  $levels]);
    }

    /**
      * store a newly added symptom
      */
    public function storeSymptom(Request $request){
      $addSymptom = DiseaseSymptom::create([
          'disease_id' => $request->input('disease'),
          'symptom_id' => $request->input('symptom'),
          'level_id' => $request->input('level')
      ]);

      //check if storage was successful
      if($addSymptom){
        return back()->withInput()->with('success','Symptom has been added successfully');
      }else{
        return back()->withInput()->with('error','Sorry, Symptom was not added');
      }
    }

    /**
      * show page for remove symptom from disease
    */
    public function removeSymptomView( $disease_id = null ){
      if(!$disease_id){
        return back();
      }

      // get the disease details symptoms to remove
      $disease = Disease::find($disease_id);

      $diease_symptom_level = DB::table('disease_symptom')
      ->select('symptoms.symptom_name', 'symptoms.symptom_id', 'levels.level_name', 'levels.level_id')
      ->join('symptoms', 'disease_symptom.symptom_id', '=', 'symptoms.symptom_id')
      ->join('levels', 'disease_symptom.level_id', '=', 'levels.level_id')
      ->where('disease_symptom.disease_id', [$disease->disease_id])
      ->get();

      return view('diseases.removesymptom', ['disease' => $disease, 'disease_symptom_level' => $diease_symptom_level]);
    }

    /**
      * remove the symptom from the disease
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $disease_created = Disease::create([
          'disease_name' => $request->input('disease'),
          'description' => $request->input('disease_description')
      ]);
      //check if storage was successful
      if($disease_created){
        return redirect()->route('diseases.index')->with('success','Disease has been registered successfully');
      }else{
          return back()->withInput()->with('error','Sorry, Disease was not registered');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
      // get the disease details
      $disease = Disease::find($disease->disease_id);

      $diease_symptom_level = DB::table('disease_symptom')
      ->select('symptoms.symptom_name', 'levels.level_name')
      ->join('symptoms', 'disease_symptom.symptom_id', '=', 'symptoms.symptom_id')
      ->join('levels', 'disease_symptom.level_id', '=', 'levels.level_id')
      ->where('disease_symptom.disease_id', [$disease->disease_id])
      ->get();

      return view('diseases.show', ['disease' => $disease, 'disease_symptom_level' => $diease_symptom_level]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
      $findDisease = Disease::find($disease->disease_id);

      if($findDisease->delete()){
          return redirect()->route('diseases.index')->with('success', 'Disease has been deleted successfully');
      }
      //redirect
      return back()->withInput('error', 'Disease could not be deleted');
    }
}
