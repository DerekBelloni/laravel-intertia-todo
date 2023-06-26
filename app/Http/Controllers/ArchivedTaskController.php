<?php

namespace App\Http\Controllers;

use App\Database\Repositories\ArchivedTask\ArchiveTaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\ArchivedTask;
use App\Models\CheckList;

class ArchivedTaskController extends Controller  
{
  public static function index(Request $request)
  {
    return ArchiveTaskManager::index($request);
  }

  public static function store(Request $request) 
  {
    return ArchiveTaskManager::store($request);
  }

}