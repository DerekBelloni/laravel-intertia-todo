<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorkChecklistController extends Controller
{
   public function index(Request $request)
   {
      return Inertia::render('WorkChecklist');
   }
}

