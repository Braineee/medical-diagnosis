<?php

namespace App\Http\Controllers;

use DB;
use App\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function show($patientRecord)
    {
        //get the patient records
        $patient_record =
        DB::table('patient_records')
        ->select('patient_records.*', 'diseases.*', 'treatments.*', 'users.*')
        ->join('diseases', 'patient_records.disease_id', '=', 'diseases.disease_id')
        ->join('treatments', 'patient_records.treatment_id', '=', 'treatments.treatment_id')
        ->join('users', 'patient_records.user_id', '=', 'users.id')
        ->where('user_id', $patientRecord)
        ->get();

        if($patient_record->count() != 0){
          return view('records.show', ['patient_records' => $patient_record]);
          die();
        }

        return back()->withInput()->with('error','Sorry, no record available for this patient.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientRecordDetails  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function viewDetails($recordId)
    {
        //get the patient records details
        $patient_record_details =
        DB::table('patient_records')
        ->select('patient_records.*', 'diseases.*', 'treatments.*', 'users.*')
        ->join('diseases', 'patient_records.disease_id', '=', 'diseases.disease_id')
        ->join('treatments', 'patient_records.treatment_id', '=', 'treatments.treatment_id')
        ->join('users', 'patient_records.user_id', '=', 'users.id')
        ->where('patient_record_id', $recordId)
        ->get();


        $date_of_diagnosis = $patient_record_details->first()->created_at;
        $patient_name = $patient_record_details->first()->name;
        $patient_sex = $patient_record_details->first()->sex;
        $patient_email = $patient_record_details->first()->email;
        $patient_phone = $patient_record_details->first()->phone;
        $disease_diagnosed = $patient_record_details->first()->disease_name;

        //var_dump($disease_diagnosed);

        return view('records.record_details', [
          'patient_record_details' => $patient_record_details,
          'date_of_diagnosis' => $date_of_diagnosis,
          'patient_name' => $patient_name,
          'patient_sex' => $patient_name,
          'patient_email' => $patient_email,
          'patient_phone' => $patient_phone,
          'disease_diagnosed' => $disease_diagnosed,
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $patientRecord)
    {
        //
    }
}
