<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubTaskController extends Controller 
{
  public function store(Request $request) 
  {
    $subtask = $request->all();

    SubTask::create([
      'parent_task_id' => $subtask['parent_task_id'],
      'subtask_type' => $subtask['subtask_type'],
      'subtask_body' => $subtask['task_body']
    ]);
  }

  public function update(Request $request)
  {
    $subtask = $request->all();

    SubTask::where('id', $subtask['id'])->update([
      'subtask_completed' => $subtask['task_completed']
    ]);
  }

  public function delete(Request $request)
  {
    $subtask = $request->all();
    SubTask::where('id', $subtask['subtask_id'])->delete();
  }
}