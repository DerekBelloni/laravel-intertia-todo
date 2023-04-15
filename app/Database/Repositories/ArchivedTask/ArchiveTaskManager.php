<?php

namespace App\Database\Repositories\ArchivedTask;

use Illuminate\Http\Request;
use App\Models\ArchivedTask;

class ArchiveTaskManager
{
  public static function store(Request $request)
  {
    $task = $request->all();

    ArchivedTask::create([
      'task_id' => $task['id'],
      'user_id' => $task['user_id'],
      'task_title' => $task['checklist_title'],
      'task_body' => $task['checklist_item_body'],
      'task_type' => 'work'
    ]); 
  }
}