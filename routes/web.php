<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Get here only when the user is logged in

Route::middleware(['auth'])->group(function(){

  // middleware for doctors
  Route::middleware(['doctor'])->group(function() {
    //Disease
    Route::get('/diseases/{disease_id?}', 'DiseaseController@destroy')->name('diseases.deleteDisease');
    Route::get('/diseases/add-symptom/{disease_id?}', 'DiseaseController@addsymptom')->name('diseases.addSymptom');
    Route::post('/diseases/addsymptom/', 'DiseaseController@storeSymptom')->name('diseases.storeSymptom');
    Route::get('/diseases/remove-symptom/{disease_id?}', 'DiseaseController@removeSymptomView')->name('diseases.removeSymptomView');
    Route::post('/diseases/removesymptom/', 'DiseaseController@removeSymptom')->name('diseases.removeSymptom');
    Route::resource('diseases', 'DiseaseController');
    //Symptom
    Route::get('/symptoms/{symptom_id?}', 'SymptomController@destroy')->name('symptoms.deleteSymptom');
    Route::resource('symptoms', 'SymptomController');
    //Treatment
    Route::get('/treatments/{treatment_id?}', 'TreatmentController@destroy')->name('treatments.deleteTreatment');
    Route::resource('treatments', 'TreatmentController');
    // new symptom
    Route::post('registerDieseaseSymptom', 'NewSymptomController@registerDieseaseSymptom')->name('newSymptoms.registerDieseaseSymptom');
    Route::resource('newsymptoms', 'NewSymptomController');
  });

  //patients
  Route::resource('patients', 'PatientController');

  //doctors
  Route::resource('doctors', 'DoctorController');

  //diagnosis
  Route::post('keepSymptom', 'DiagnosisController@ajaxKeepSymptom')->name('diagnosis.keepSymptom');
  Route::post('diagnosePatient', 'DiagnosisController@ajaxDiagnosePatient')->name('diagnosis.DiagnosePatient');
  Route::get('/diagnosis/preview_symptoms', 'DiagnosisController@diagnosisPreview')->name('diagnosis.diagnosisPreview');
  Route::resource('diagnosis', 'DiagnosisController');

  //records
  Route::get('records/view_details/{record_id?}', 'PatientRecordController@viewDetails')->name('records.viewDetails');
  Route::resource('records', 'PatientRecordController');

  //logout function
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
