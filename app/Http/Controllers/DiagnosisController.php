<?php

namespace App\Http\Controllers;

use App\DiseaseSymptom;
use App\PatientRecord;
use App\NewSymptom;
use App\Disease;
use App\Treatment;
use App\Symptom;
use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        die('NB: Please go back and select a symptom first');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxDiagnosePatient()
    {
      //get the disease from the symptoms
      $list_of_suspected_diseases_id = array();
      $list_of_disease_typifed = array();
      $disease_diagnosed = null;
      $disease_diagnosed_id = 0;
      $suggested_treatment = null;
      $suggested_treatment_id = 1;
      $diagnosis_result = array();
      // return the percetage of occurance of this disease
      function calculateThePercentage($disease, $max_value){
        $percentage = ($disease/$max_value)*100;
        return round($percentage, 2);
      }

      // return the number of occurance of this disease
      function countOccurance($value, $array) {
        return count(array_keys($array, $value));
      }


      if(session()->has('symptoms_for_diagnosis') &&
         session()->get('symptoms_for_diagnosis') != null){

           //get the list of Symptoms
           $selected_symptoms = session()->get('symptoms_for_diagnosis');

           //get the list of diseases
           foreach ($selected_symptoms as $value) {
             //get the set of disease with the symptoms
             $get_the_disease = DiseaseSymptom::where([
                ['symptom_id', '=', $value['symptom_id']],
                ['level_id', '=', $value['level_id']]
             ])->get();

             if($get_the_disease->count() != 0){
               foreach ($get_the_disease as $value) {
                 //push it to the $list_of_suspected_diseases_id
                 array_push($list_of_suspected_diseases_id, $value->disease_id);
                 //push it to the $list_of_disease_typifed
                 if(!in_array($value->disease_id, $list_of_disease_typifed)){
                   array_push($list_of_disease_typifed, $value->disease_id);
                 }
               }
            }else{
              //insert it to the new symptoms
              $get_random_number = mt_rand(100000, 999999);
              foreach(session()->get('symptoms_for_diagnosis') as $value) {
                $new_symptom = NewSymptom::create([
                  'symptom_id' => $value['symptom_id'],
                  'level_id' => $value['level_id'],
                  'case_id' => $get_random_number
                ]);
              }

              //empty the diagnosis array
              session()->put('symptoms_for_diagnosis', array());

              return response()->json([
                'error'=> 'Could not diagnose a disease with this symptoms please try again later',
              ]);
              die();
            }
          }// end of get the list of disease

          //calculate the result
          $count = 0;
          while(count($list_of_disease_typifed) > $count){
            //get the number of occurance
            $number_of_occurance_of_disease_in_the_set = countOccurance($list_of_disease_typifed[$count], $list_of_suspected_diseases_id);
            //get the fraction percentage of this occurance from the deasease set
            $fraction_percentage_of_occurance_of_disease_in_the_set
            = calculateThePercentage($number_of_occurance_of_disease_in_the_set, count($list_of_suspected_diseases_id));

            //get the name of this diseases
            $name_of_disease = Disease::find($list_of_disease_typifed[$count]);


            array_push($diagnosis_result, [
              'disease_id' => $list_of_disease_typifed[$count],
              'disease' => $name_of_disease->disease_name,
              'percentage' => $fraction_percentage_of_occurance_of_disease_in_the_set
            ]);


            $count ++;
          }

          //calculate the diease with the highest percentage
          $highest = 0;
          foreach($diagnosis_result as $value) {
            if($value['percentage'] > $highest){
              $highest = $value['percentage'];
              $disease_diagnosed = $value['disease'];
              $disease_diagnosed_id = $value['disease_id'];
            }
          }

          //get the treatment for the diagnosed disease
          $get_suggested_treatment = Treatment::where('disease_disease_id', $disease_diagnosed_id)->get();
          if($get_suggested_treatment->count() > 0){
            $suggested_treatment = $get_suggested_treatment->first()->treatment;
            $suggested_treatment_id = $get_suggested_treatment->first()->treatment_id;
          }else{
            $suggested_treatment = "No available treatment for this disease for now";
          }

          //insert into the patients record
          $symptoms_ = " ";
          foreach(session()->get('symptoms_for_diagnosis') as $value) {
            $get_the_symptom = Symptom::find($value['symptom_id']);
            //get the symptom name
            $symptom_name = $get_the_symptom->symptom_name;
            //get the level name
            $get_the_level = Level::find($value['level_id']);
            $level_name = $get_the_level->level_name;
            $symptoms_ .= $symptom_name.'-'.$level_name.', ';
          }


          $patient_record = PatientRecord::create([
              'user_id' => Auth::user()->id,
              'disease_id' => $disease_diagnosed_id,
              'treatment_id' => $suggested_treatment_id,
              'symptoms' => $symptoms_
          ]);



          //empty the diagnosis array
          session()->put('symptoms_for_diagnosis', array());

          return response()->json([
            'success'=> true,
            'diagnosis_result' => $diagnosis_result,
            'disease_diagnosed' => $disease_diagnosed,
            'suggested_treatment' => $suggested_treatment
          ]);

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
