<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Comments\CommentsManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CommentsController extends Controller 
{
  public static function store(Request $request)
  {
    return CommentsManager::store($request);
  }
}