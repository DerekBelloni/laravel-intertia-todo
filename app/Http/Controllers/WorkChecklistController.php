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
      $tasks = WorkCheckList::where('user_id', Auth()->id())
         ->get();

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

      foreach($work_tasks as $task) {
         WorkCheckList::where('id', $task['id'])
            ->update([
               'task_completed' => $task['task_completed']
            ]);
      }
   }
}

