<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\ArchivedTask;
use App\Models\WorkCheckList;

class ArchivedTaskController extends Controller  
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