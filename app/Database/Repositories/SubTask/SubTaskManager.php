<?php

namespace App\Database\Repositories\SubTask;

use Illuminate\Http\Request;
use App\Models\SubTask;

class SubTaskManager
{
  public static function store(Request $request) 
  {
    $subtask = $request->all();

    SubTask::create([
      'parent_task_id' => $subtask['parent_task_id'],
      'subtask_type' => $subtask['subtask_type'],
      'subtask_body' => $subtask['task_body']
    ]);
  }

  public static function update(Request $request)
  {
    $subtask = $request->all();

    SubTask::where('id', $subtask['id'])->update([
      'subtask_completed' => $subtask['task_completed']
    ]);
  }

  public static function delete(Request $request)
  {
    $subtask = $request->all();
    SubTask::where('id', $subtask['subtask_id'])->delete();
  }

}