<?php

namespace App\Database\Repositories\Checklist;

use Illuminate\Http\Request;
use App\Models\CheckList;
use Inertia\Inertia;
use Carbon\Carbon;

class CheckListManager 
{
  public static function index(Request $request)
  {
    $tasks = CheckList::with(['subTasks', 'comments'])->where('user_id', Auth()->id())
    ->get(); 
    
    return Inertia::render('Checklist', [
        "tasks" => $tasks
    ]);
  }

  public static function store(Request $request)
  {
    CheckList::create([
       "user_id" => Auth()->id(),
       "checklist_title" => $request->input('task_title'),
       "checklist_item_body" => $request->input('task_body'),
       'task_completed' => false
    ]);
  }

  public static function update(Request $request)
  {
    $work_tasks = $request->all();

    if (isset($work_tasks['due_date'])) {
      $due_date = Carbon::parse($work_tasks['due_date']);
    }

    CheckList::where('id', $work_tasks["id"])
       ->update([
          'task_completed'=> $work_tasks["task_completed"],
          'due_date' => $due_date ?? null
       ]);
  }

  public static function delete(Request $request)
  {
    $work_task_id = $request->input('task_id');
    CheckList::where('id', $work_task_id)->delete();
  }
}