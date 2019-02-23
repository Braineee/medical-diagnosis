<?php

namespace App\Http\Controllers;

use DB;
use App\NewSymptom;
use App\DiseaseSymptom;
use App\Symptom;
use App\Disease;
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
      $last_key = array();
        // get the list of new Symptoms
        $new_symptoms = NewSymptom::all();
        //echo '<pre>';
        //group the symptom
        foreach ($new_symptoms as $symptom) {
          if($symptom->added !== 1){
            if(!in_array($symptom->case_id, $last_key)){
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
              //$last_key = $symptom->case_id;
              $case = array();
            }
            array_push($last_key, $symptom->case_id);
          }
        }
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
    public function show($case_id = null)
    {
        // echo '<pre>';
        //get the new symptoms
        $new_symptom = DB::table('new_symptoms')
        ->select('symptoms.*', 'levels.*', 'new_symptoms.*')
        ->join('symptoms', 'new_symptoms.symptom_id', '=', 'symptoms.symptom_id')
        ->join('levels', 'new_symptoms.level_id', '=', 'levels.level_id')
        ->where('case_id','=',$case_id)
        ->get();
        // get the list of the diseases
        $dieseases = Disease::all();
        //get the case id
        $case_id = $new_symptom[0]->case_id;

        //var_dump($new_symptom);
        //die();

        return view('newsymptoms.show', ['symptoms' => $new_symptom, 'diseases' => $dieseases, 'case_id' => $case_id ]);
    }

    /**
    * save the disease and the symptoms
    */
    public function registerDieseaseSymptom(Request $request){

        $newSymptoms = NewSymptom::where('case_id', $request->input('case_id'))->get();
        //var_dump($request->input('case_id'));
        foreach($newSymptoms as $newSymptom){
          // add the symptom to the database
          $addSymptom = DiseaseSymptom::create([
              'disease_id' => $request->input('disease'),
              'symptom_id' => $newSymptom->symptom_id,
              'level_id' => $newSymptom->level_id
          ]);
        }

        // update the record as added (1)
        $updateSymptom = NewSymptom::where('case_id', $request->input('case_id'))->update([
          'added' => 1,
        ]);

       if($updateSymptom){
         return redirect()->route('newsymptoms.index')->with('success', 'Disease was successfully registered with symptoms');
       }

       return back()->withInput('error', 'Disease was not registered with symptoms');
    }
}
