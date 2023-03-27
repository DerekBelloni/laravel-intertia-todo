<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WorkCheckList extends Model {
  
  protected $table = 'work_checklists';
  protected $guarded = [];
  protected $casts = [
    'task_completed' => 'boolean'
  ];

  // create relationship with user

}