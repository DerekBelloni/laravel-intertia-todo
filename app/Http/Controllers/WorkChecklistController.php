<?php

namespace App\Http\Controllers;

use App\Database\Repositories\WorkChecklist\WorkCheckListManager;
use App\Models\WorkCheckList;
use Illuminate\Http\Request;

class WorkChecklistController extends Controller
{
   public function index(Request $request)
   {
      return WorkCheckListManager::index($request);
   }

   public function store(Request $request) 
   {
      return WorkCheckListManager::store($request);
   }

   public function update(Request $request) 
   {
      return WorkCheckListManager::update($request);
   }

   public function delete(Request $request) {
      return WorkCheckListManager::delete($request);
   }
}

