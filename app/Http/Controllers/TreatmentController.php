<?php

namespace App\Http\Controllers;

use App\Treatment;
use App\Disease;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the list of diseases
        $diseases = Disease::all();
        return view('treatments.index', ['diseases' => $diseases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //get the list of diseases
      $diseases = Disease::all();
      return view('treatments.create', ['diseases' => $diseases]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $treatment_created = Treatment::create([
          'disease_disease_id' => $request->input('disease_to_treat'),
          'treatment' => $request->input('treatment')
      ]);
      //check if storage was successful
      if($treatment_created){
        return redirect()->route('treatments.index')->with('success','Treatment has been created successfully');
      }else{
          return back()->withInput()->with('error','Sorry, Treatment was not created');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show($disease_id = null)
    {
      // check if the disease variable is empty
      if(!$disease_id){
        return back();
      }
      // get the disease form the database
      $disease = Disease::find($disease_id);
      // get the treatment for the disease
      $treatment = $disease->treatment;

      return view('treatments.show', ['disease' => $disease, 'treatments' => $treatment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
      //get the list of diseases
      $treatment = Treatment::find($treatment->treatment_id);
      $disease = $treatment->disease;
      return view('treatments.edit', ['diseases' => $diseases, 'treatment' => $disease]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment)
    {
      $updateTreatment = Treatment::where('treatment_id', $treatment->treatment_id)->update([
        'treatment_name' => $request->input('treatment'),
        'description' => $request->input('treatment_description')
      ]);

      if($updateTreatment){
          return redirect()->route('treatments.index')->with('success', 'Treatment was updated successfully');
      }
      //redirect
      return back()->withInput('error', 'Treatment could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
      $findTreatment = Treatment::find($treatment->treatment_id);

      if($findTreatment->delete()){
          return back()->with('success', 'Treatment has been deleted successfully');
      }
      //redirect
      return back()->withInput('error', 'Treatment could not be deleted');
    }
}
