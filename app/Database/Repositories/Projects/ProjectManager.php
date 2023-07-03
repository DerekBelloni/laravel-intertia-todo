<?php

namespace App\Database\Repositories\Projects;

use Illuminate\Http\Request;
use App\Models\CheckList;
use Inertia\Inertia;
use Carbon\Carbon;

class ProjectManager
{
  public static function store(Request $request)
  {
    dd($request->all(), 'banana');
  }
}