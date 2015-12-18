<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\Models\Task;

class TasksController extends Controller {
	public function index(){
		$tasks = Task::all();

        return response()->json(['status' => 'success', 'data' => $tasks ]);

	}


	public function store(){

	    $data = Input::all();

        if(is_array($data) && !empty($data)){
            unset($data['_token']);

            $task = Task::create(
                array(
                    "title" => $data['title'],
                    "description" => $data['description'],
                    "due_date" =>  date("Y-m-d h:i:s",strtotime($data['due_date'])),
                    "status" => $data['status']
                )
            );
            return response()->json(['status' => 'success', 'data' => $task ]);
        }
        else{
            return response()->json(['status' => 'error', 'msg' => "Invalid data!" ]);
        }

	}


	public function update(){
        $task = Task::find(Input::get("id"));

        if(!$task){
            Session::flash('error', trans("tasks.notifications.no_exists"));

            return Redirect::to("/tasks");
        }

        $name = Input::has("name") ? Input::get("name") : "";
        
        if($name == ""){
            Session::flash("error", trans("tasks.notifications.field_name_missing"));

            return Redirect::to("/tasks/$task->id/edit")->withInput();
        }

        $task->name = $name;

        $task->save();

        Session::flash('success', trans("tasks.notifications.update_successful"));

        return Redirect::to("/tasks");
	}

	public function active($id){
        $task = Task::find($id);

        if(!$task){
            return response()->json(['status' => 'error', 'msg' => "Invalid task!" ]);
        }

        $task->status = 1;
        $task->save();

        return response()->json(['status' => 'success', 'data' => $task ]);
	}

	public function deactive($id){
        $task = Task::find($id);

        if(!$task){
            return response()->json(['status' => 'error', 'msg' => "Invalid task!" ]);
        }

        $task->status = 0;
        $task->save();

        return response()->json(['status' => 'success', 'data' => $task ]);
    }

    public function destroy(){
        $task = Task::find(Input::get("id"));

        if(!$task){
            return response()->json(['status' => 'error', 'msg' => "Invalid task!" ]);
        }

        $task->delete();

        return response()->json(['status' => 'success' ]);
    }
}