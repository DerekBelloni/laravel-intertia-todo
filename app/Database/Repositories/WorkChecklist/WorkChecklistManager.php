<?php

namespace App\Database\Repositories\WorkChecklist;

use Illuminate\Http\Request;
use App\Models\WorkCheckList;
use Inertia\Inertia;

class WorkCheckListManager 
{
  public static function index(Request $request)
  {
    $tasks = WorkCheckList::with(['subTasks', 'comments'])->where('user_id', Auth()->id())
    ->get(); 

    $user = Auth()->user();
    
    return Inertia::render('WorkChecklist', [
        "tasks" => $tasks
    ]);
  }

  public static function store(Request $request)
  {
    $checklist_body  = $request->input('task_body');   

    WorkCheckList::create([
       "user_id" => Auth()->id(),
       "checklist_title" => "test",
       "checklist_item_body" => $checklist_body,
       'task_completed' => false
    ]);
  }

  public static function update(Request $request)
  {
    // dd($request->all());
    $work_tasks = $request->all();

    WorkCheckList::where('id', $work_tasks["id"])
       ->update([
          'task_completed'=> $work_tasks["task_completed"]
       ]);
  }

  public static function delete(Request $request)
  {
    $work_task_id = $request->input('task_id');
    WorkCheckList::where('id', $work_task_id)->delete();
  }
}