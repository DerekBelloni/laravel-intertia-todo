<?php

namespace App\Http\Controllers;

use App\Database\Repositories\SubTask\SubTaskManager;
use App\Models\SubTask;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubTaskController extends Controller 
{
  public function store(Request $request) 
  {
    return SubTaskManager::store($request);
  }

  public function update(Request $request)
  {
    return SubTaskManager::update($request);
  }

  public function delete(Request $request)
  {
    return SubTaskManager::delete($request);
  }
}