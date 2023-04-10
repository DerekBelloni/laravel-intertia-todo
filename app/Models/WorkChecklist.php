<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubTask;

class WorkCheckList extends Model {
  
  protected $table = 'work_checklists';
  protected $guarded = [];
  protected $casts = [
    'task_completed' => 'boolean',
    'created_at' => 'date:m-d-Y'
  ];

  // create relationship with user

  // Relationships
  public function subTasks()
  {
    return $this->hasMany(SubTask::class, 'parent_task_id', 'id');
  }

}