<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Checklist\CheckListManager;
use App\Models\CheckList;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
   public function index(Request $request)
   {
      return CheckListManager::index($request);
   }

   public function store(Request $request) 
   {
      return CheckListManager::store($request);
   }

   public function update(Request $request) 
   {
      return CheckListManager::update($request);
   }

   public function delete(Request $request) 
   {
      return CheckListManager::delete($request);
   }
}

