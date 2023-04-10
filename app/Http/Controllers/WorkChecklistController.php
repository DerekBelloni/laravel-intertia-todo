<?php

namespace App\Http\Controllers;

use App\Models\WorkCheckList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class WorkChecklistController extends Controller
{
   public function index(Request $request)
   {
      $tasks = WorkCheckList::with('subTasks')->where('user_id', Auth()->id())
         ->get(); 

      // dd($tasks);
      return Inertia::render('WorkChecklist', [
         "tasks" => $tasks
      ]);
   }

   public function store(Request $request) {
      $checklist_body  = $request->input('task_body');   

      WorkCheckList::create([
         "user_id" => Auth()->id(),
         "checklist_title" => "test",
         "checklist_item_body" => $checklist_body,
         'task_completed' => false
      ]);
   }

   public function update(Request $request) {
      $work_tasks = $request->all();

      WorkCheckList::where('id', $work_tasks["id"])
         ->update([
            'task_completed'=> $work_tasks["task_completed"]
         ]);
   }

   public function delete(Request $request) {
      $work_task_id = $request->input('task_id');
      WorkCheckList::where('id', $work_task_id)->delete();
   }
}

