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

  Route::middleware(['doctor'])->group(function() {
    //Disease
    Route::resource('diseases', 'DiseaseController');

    //Symptom
    Route::resource('symtomps', 'SymptomController');

    //Treatment
    Route::resource('treatments', 'TreatmentController');

    //Disease symptoms
    Route::resource('disease symptoms', 'DiseaseSymptomController');
  });



  //Users
  Route::get('/patients', 'PatientController@index')->name('user.patients');


  //logout function
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});
