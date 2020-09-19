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


Route::resource('topics','TopicController');

Route::resource('questions','QuestionController');

//question sin resource
Route::get('questionsTwo/{slug}','QuestionTwoController@create')->name('addQ');
Route::post('questionsTwo/{id}', 'QuestionTwoController@store')->name('saveQ');
// Route::get('questionTwo/{slug}', function (App\topic $topic){
//     return $topic->slug;
// })->name('addQ');

Route::get('questionTwo/{slug}', 'QuestionTwoController@index')->name('principalQ');
Route::delete('questionTwo/{slug}/{id}','QuestionTwoController@destroy')->name('deleteQ');

//seccion para los cuestionarios
Route::get('panelCuestion/{slug}','panelQuestionController@index')->name('panelQ');
Route::get('panelSecuencial/{slug}','panelQuestionController@opSecuencial')->name('pSecuencial');
Route::post('panelRevisar/{slug}','panelQuestionController@checkAnswer')->name('pCheck');
Route::get('panelContinue/{slug}','panelQuestionController@continueQuestion')->name('pContinueQ');

//prueba para los cuestionarios
Route::get('panelPrueba/{slug}','panelQuestionTwoController@show')->name('panelPrueba');
