<?php

namespace App\Http\Controllers;

use App\Disease;
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
      //$project = Project::where('id', $project->id)->first();
      $disease = Disease::find($disease->disease_id);

      //pass the project comments to the comments variable
      //$symptoms = $disease->symptoms;

      return view('diseases.show', ['disease' => $disease]);
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
