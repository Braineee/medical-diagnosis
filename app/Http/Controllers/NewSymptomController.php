<?php

namespace App\Http\Controllers;

use DB;
use App\NewSymptom;
use App\Symptom;
use App\Level;
use Illuminate\Http\Request;

class NewSymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $new_symptoms_arranged = array();
      $case = array();
      $index = 0;
      $last_key = 0;
        // get the list of new Symptoms
        $new_symptoms = NewSymptom::all();

        //group the symptom
        foreach ($new_symptoms as $symptom) {
          if($symptom->added !== 1){
            if($symptom->case_id !== $last_key){
              $symptom_list =
              DB::table('new_symptoms')
              ->select('symptoms.*', 'levels.*', 'new_symptoms.*')
              ->join('symptoms', 'new_symptoms.symptom_id', '=', 'symptoms.symptom_id')
              ->join('levels', 'new_symptoms.level_id', '=', 'levels.level_id')
              ->where('new_symptoms.case_id', $symptom->case_id)
              ->get();
              foreach($symptom_list as $symtom_){
                array_push($case, [$symtom_->symptom_name => $symtom_->level_name]);
              }
              array_push($new_symptoms_arranged, [$symptom->case_id => $case]);
              $last_key = $symptom->case_id;
              $case = array();
            }
          }
        }


        //return the aggregated data

        /*var_dump($new_symptoms_arranged);

        foreach ($new_symptoms_arranged as $value) {
          foreach ($value as $key => $value2) {
            var_dump($key);
            foreach ($value2 as $key2 => $value3) {
              var_dump($value3);
            }
          }
        }
        die();*/
        return view('newsymptoms.index', ['newSymptoms' => $new_symptoms_arranged]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewSymptom  $newSymptom
     * @return \Illuminate\Http\Response
     */
    public function show(NewSymptom $newSymptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewSymptom  $newSymptom
     * @return \Illuminate\Http\Response
     */
    public function edit(NewSymptom $newSymptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewSymptom  $newSymptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewSymptom $newSymptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewSymptom  $newSymptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewSymptom $newSymptom)
    {
        //
    }
}
