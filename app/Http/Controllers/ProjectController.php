<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Projects\ProjectManager;
use Illuminate\Http\Request;

class ProjectController extends Controller 
{
  public function store(Request $request) 
  {
    return ProjectManager::store($request);
  }
}