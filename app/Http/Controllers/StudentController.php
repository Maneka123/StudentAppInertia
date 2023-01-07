<?php

namespace App\Http\Controllers;
use     App\Models\Student;
use Illuminate\Http\Request;
use domain\Facades\StudentFacade;
use App\Http\Controllers\StudentController;
Use Inertia\Inertia;
class StudentController extends Controller
{
    //protected $task;

    //public function __construct(){
        //$this->task=new Student();
   // }
      //inertia facade is used to render the contents of the index file from backend
    public function index(){
        //$response['tasks']=StudentFacade::all();
        //return view('pages\todo\index')->with($response);
        return Inertia::render('Student/index');
    }
    public function store(Request $request){
        //$this->task->create($request->all());
        //dd($request->all());
        return StudentFacade::store($request->all());
      // $response=StudentFacade::all();
        //return response()->json($response);
        //return redirect()->back();
    }

    public function list(){
      $tasks=StudentFacade::all();
      return response()->json($tasks);
  }

  public function get($task_id){
    $task=StudentFacade::get($task_id);
    return response()->json($task);
}

    public function delete($student_id){
      //$task=$this->task->find($student_id);
        //$task->delete();
      return StudentFacade::delete($student_id);
      //return redirect()->back();
    }

    public function done($student_id){
        //$task=$this->task->find($student_id);
       // $task->done=1;
       // $task->update();

       // $task->done = !$task->done;
       // $task->save();

       return StudentFacade::done($student_id);


        //return redirect()->back();
      }

      public function edit(Request $request){
        $response['task']=StudentFacade::get($request['student_id']);
        return view('pages.todo.edit')->with($response);
      }

      public function update(Request $request,$student_id){
        return StudentFacade::update($request->all(),$student_id);
        //return redirect()->back();
      }

      public function editStudent($id){
        $student=Student::find(id);
        return response()->json([
            'status'=>200,
             'student'=>$student,
        ]);
      }
   
}
