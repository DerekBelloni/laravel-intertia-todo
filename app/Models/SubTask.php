<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model {
  protected $table = 'subtask';
  protected $guarded = [];
  protected $casts = [
    'subtask_completed' => 'boolean'
  ];
}