<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Dashboard\DashboardManager;
use Illuminate\Http\Request;

class DashboardController extends Controller 
{
  public static function index(Request $request)
  {
    return DashboardManager::index($request);
  }
}