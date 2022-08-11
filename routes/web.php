<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('setlocale/{locale}',function($lang){
    \Session::put('locale',$lang);
    return redirect()->back();   
})->name('lang');


Route::get('/', function () {
    return view('prelogin');
})->name('prelogin')->middleware(['language','guest']);


Route::group([ 'middleware' => 'language'], function () {
    Auth::routes();
});



Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post('generator_builder/generate-from-file', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');

Route::resource('users', App\Http\Controllers\UserController::class)->middleware(['auth:web,clientweb','language']);


Route::resource('clients', App\Http\Controllers\ClientController::class)->middleware(['auth:web,clientweb','language']);


Route::resource('projects', App\Http\Controllers\ProjectController::class)->middleware(['auth:web,clientweb','language']);


Route::resource('tasks', App\Http\Controllers\TaskController::class)->middleware(['auth:web,clientweb','language']);


Route::resource('projectStatuses', App\Http\Controllers\ProjectStatusController::class)->middleware(['auth:web,clientweb','language']);

Route::get('/projects/{id}/taskstimeline', [App\Http\Controllers\ProjectController::class, 'showTasksTimeline'])->name('taskstimeline')->middleware(['auth:web,clientweb','language']);

Route::get('/projects/{id}/showtasks/{milestone}', [App\Http\Controllers\ProjectController::class, 'showProjectTasks'])->name('showprojecttasks')->middleware(['auth:web,clientweb','language']);
Route::get('/projects/{id}/edittasks/{task}', [App\Http\Controllers\ProjectController::class, 'editProjectTasks'])->name('editprojecttasks')->middleware(['auth:web,clientweb','language']);
Route::post('/projects/{id}/updatetasks/{task}', [App\Http\Controllers\ProjectController::class, 'updateProjectTasks'])->name('updateprojecttasks')->middleware(['auth:web,clientweb','language']);


//Route::view('/prelogin', 'prelogin')->name('prelogin')->middleware('language');
Route::view('/client/login','auth.clientlogin')->name('clientlogin')->middleware(['language','guest']);
Route::post('client/login', [App\Http\Controllers\ClientAuthController::class, 'login']) ->name('client.handleLogin');

Route::get('/clients/{id}/createproject', [App\Http\Controllers\ProjectController::class, 'create'])->name('createproject')->middleware(['auth:web,clientweb','language']);
Route::delete('/projects/deletedesigner/{user}', [App\Http\Controllers\ProjectController::class, 'deleteDesigner'])->name('deletedesigner')->middleware(['auth:web,clientweb','language']);



Route::post('/users/search', [App\Http\Controllers\UserController::class, 'search'])->name('usersearch')->middleware(['auth:web,clientweb','language']);
Route::post('/projects/search', [App\Http\Controllers\ProjectController::class, 'search'])->name('projectsearch')->middleware(['auth:web,clientweb','language']);
Route::post('/tasks/search', [App\Http\Controllers\TaskController::class, 'search'])->name('tasksearch')->middleware(['auth:web,clientweb','language']);
Route::post('/clients/search', [App\Http\Controllers\ClientController::class, 'search'])->name('clientsearch')->middleware(['auth:web,clientweb','language']);
