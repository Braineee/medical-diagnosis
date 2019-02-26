<?php

namespace App\Http\Controllers;

use App\DiseaseSymptom;
use App\Symptom;
use App\Level;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check if the symptoms has been select ed before and clear it
        if(session()->has('symptoms_for_diagnosis') &&
         session()->get('symptoms_for_diagnosis') != null){
           session()->put('symptoms_for_diagnosis', array());
         }
        //get the list of Symptoms
        $symptoms = Symptom::all();
        //get the levels
        $levels = Level::all();
        //return the view
        return view('diagnosis.index', ['symptoms' => $symptoms, 'levels' => $levels]);

    }

    /**
     * store the list of patients symptoms temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxKeepSymptom(Request $request)
    {
      $symptoms_level = array(
        'symptom_id' => $request->symptom,
        'level_id' => $request->level
      );

      /*$request->session()->put('symptoms_for_diagnosis', array());
      echo '<pre>';
      var_dump($request->session()->get('symptoms_for_diagnosis'));
      if($request->session()->has('symptoms_for_diagnosis') == true){
        var_dump(true);
      }
      die();*/

      //check if the symptoms_for_diagnosis variable is set
      if($request->session()->has('symptoms_for_diagnosis') && $request->session()->get('symptoms_for_diagnosis') != null){
        //yes, it is set
        foreach ($request->session()->get('symptoms_for_diagnosis') as $symptoms_for_diagnosis){
          //var_dump('got to loop');
          //check if the user has selected this symptom before
          //var_dump($symptoms_for_diagnosis['symptom_id']);
          //var_dump($symptoms_level['symptom_id']);
          if(intVal($symptoms_for_diagnosis['symptom_id']) == intVal($symptoms_level['symptom_id'])){
            //yes, the user has selected it before
            //check if the level id are the same
            if($symptoms_for_diagnosis['level_id'] == $symptoms_level['level_id']){
              //yes the level id are the same
              return response()->json(['error'=>'You have selected the symptom previously']);
              die();
            }else{
              //no, the level id are not the same
              //pass the new level to the old one
              //$request->session()->get('symptoms_for_diagnosis')[$key]['level_id'] = $symptoms_level['level_id'];

              //transfer the array to temp array
              $temp_array = $request->session()->get('symptoms_for_diagnosis');
              //empty the session array
              $request->session()->put('symptoms_for_diagnosis', array());
              //loop tru the new array (if the id of the new array is equal to the id of the change then change)
              foreach($temp_array as $items){
                if($items['symptom_id'] != $symptoms_level['symptom_id']){
                  $insert = array(
                    'symptom_id' => $items['symptom_id'],
                    'level_id' => $items['level_id']
                  );
                  $request->session()->push('symptoms_for_diagnosis', $insert);
                }else{
                  $insert = array(
                    'symptom_id' => $items['symptom_id'],
                    'level_id' => $symptoms_level['level_id']
                  );
                  $request->session()->push('symptoms_for_diagnosis', $insert);
                }
              }
              $temp_array = array();
              /*var_dump('got to edited');
              echo '<pre>';
              var_dump($request->session()->get('symptoms_for_diagnosis')[$key]['level_id']);
              var_dump($symptoms_level['level_id']);*/
              //var_dump($request->session()->get('symptoms_for_diagnosis'));
              return response()->json(['success'=>'symptom edited']);
              die();
            }
          }else{
            $it_exists = false;
            foreach ($request->session()->get('symptoms_for_diagnosis') as $symptoms_for_diagnosis){
              if(intVal($symptoms_for_diagnosis['symptom_id']) == intVal($symptoms_level['symptom_id'])){
                $it_exists = true;
              }
            }
            if($it_exists == false){
              //var_dump('symptom array exists but symptom created');
              //no, the user has not selected this symptom before
              $request->session()->push('symptoms_for_diagnosis', $symptoms_level);
              //echo '<pre>';
              //var_dump($request->session()->get('symptoms_for_diagnosis'));
              return response()->json(['success'=>'symptom saved']);
              die();
            }
          }
        }//end of loop

      }else{
        /*var_dump('symptom array does not exists but symptom created');
        //no, it is not set*/
        $request->session()->push('symptoms_for_diagnosis', $symptoms_level);
        //echo '<pre>';
        //var_dump($request->session()->get('symptoms_for_diagnosis'));
        return response()->json(['success'=>'symptom saved']);
        die();
      }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function diagnosisPreview()
    {

      //echo '<pre>';
      /*var_dump(session()->get('symptoms_for_diagnosis'));
      die();*/

      if(session()->has('symptoms_for_diagnosis') &&
         session()->get('symptoms_for_diagnosis') != null){


           //get the list of Symptoms
           $selected_symptoms = session()->get('symptoms_for_diagnosis');
           $selected_symptoms_name = array();

           foreach ($selected_symptoms as $value) {
             //get the symptom name
             $get_the_symptom = Symptom::find($value['symptom_id']);

             $symptom_name = $get_the_symptom->symptom_name;

             //get the level name
             $get_the_level = Level::find($value['level_id']);
             $level_name = $get_the_level->level_name;

             //pass the array to the main array
             array_push($selected_symptoms_name, ['symptom_name' => $symptom_name, 'level_name' => $level_name]);
           }

           /*echo '<pre>';
           var_dump($selected_symptoms_name);
           die();*/

           //return the view
           return view('diagnosis.preview', ['selected_symptoms' => $selected_symptoms_name]);

      }else{
        var_dump('cannot work');
        return back()->withInput()->with('error','Sorry, Please select some symptoms before proceeding');
      }
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
     * @param  \App\DiseaseSymptom  $diseaseSymptom
     * @return \Illuminate\Http\Response
     */
    public function show(DiseaseSymptom $diseaseSymptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiseaseSymptom  $diseaseSymptom
     * @return \Illuminate\Http\Response
     */
    public function edit(DiseaseSymptom $diseaseSymptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiseaseSymptom  $diseaseSymptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiseaseSymptom $diseaseSymptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiseaseSymptom  $diseaseSymptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiseaseSymptom $diseaseSymptom)
    {
        //
    }
}
