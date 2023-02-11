<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//RUTAS DE USUARIO
Route::controller(UserController::class)->group(
	function($router) {
		Route::post('/register', 'register');
		Route::post('/login', 'authenticate');
});

//RUTAS CON TOKEN MIDDLEWARE
Route::group(['middleware' => ['jwt.verify']], function() {
    //RUTAS DE TAREAS
	Route::controller(TaskController::class)->group(
		function($router) {
			Route::get('/all/tasks', 'allTasks');
			Route::get('/show/task/{id}', 'showTask');
			Route::post('/create/task', 'createTask');
			Route::post('/update/task/{id}', 'updateTask');
			Route::post('/delete/task/{id}', 'deleteTask');
			Route::post('/complete/task/{id}', 'completeTask');
	});

	//RUTAS USUARIO CON TOKEN
	Route::controller(UserController::class)->group(
		function($router) {
			Route::post('/logout', 'logout');
	}); 
});