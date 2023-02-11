<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	//funcion para crear tarea
    public function createTask(StoreTaskRequest $request) {
    	$user = auth()->user();

    	$task = new Task([
    		'title' => $request->title,
    		'contents' => $request->contents,
    		'user' => $user->id,
    		'status' => Task::DOING,
    	]);

    	$task->save();

    	return response()->json(
    		['msg' => 'Tarea creada con éxito'], 201);
    }

    //funcion para mostrar todas las tareas
    public function allTasks() {
    	$user = auth()->user();

    	$tasks = Task::where([
    		['status', '!=', Task::DELETE],
    		['user', '=', $user->id],
    	])->get();

    	return response()->json($tasks, 200);
    }

    //funcion para mostrar una tarea
    public function showTask($id) {
    	$task = Task::find($id);
        
    	return response()->json($task, 200);
    }

    //funcion para actualizar tarea
    public function updateTask(UpdateTaskRequest $request, $id) {
    	$user = auth()->user();
    	$task = Task::where('user', $user->id)->find($id);

    	$task->title = $request->title;
    	$task->contents = $request->contents;
    	$task->save();

    	return response()->json(
    		['msg' => 'Tarea actualizada con éxito'], 200);
    }

    //funcion para eliminar tarea (logico)
    public function deleteTask($id) {
    	$user = auth()->user();
    	$task = Task::where('user', $user->id)->find($id);
    	$task->status = Task::DELETE;
    	$task->update();

    	return response()->json(
    		['msg' => 'Tarea eliminada con éxito'], 200);
    }

    public function completeTask($id) {
        $user = auth()->user();
        $task = Task::where('user', $user->id)->find($id);
        $task->status = Task::COMPLETE;
        $task->update();

        return response()->json(
            ['msg' => 'Tarea eliminada con éxito'], 200);
    }
}
