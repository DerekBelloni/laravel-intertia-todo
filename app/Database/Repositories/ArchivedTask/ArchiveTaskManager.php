<?php

namespace App\Database\Repositories\ArchivedTask;

use Illuminate\Http\Request;
use App\Models\ArchivedTask;
use Inertia\Inertia;
use Carbon\Carbon;


class ArchiveTaskManager
{
  public static function index(Request $request)
  {
    $archived_tasks = ArchivedTask::where('user_id', Auth()->id())->get();
    
    $filtered_tasks = $archived_tasks->unique('task_body');

    foreach ($filtered_tasks as $task) {
      $carbon = new Carbon($task['created_at']);
      $task['formatted_date'] = $carbon->toFormattedDayDateString();
    }

    return Inertia::render('ArchivedTask', [
      'archived_tasks' => $filtered_tasks
    ]);
  }


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