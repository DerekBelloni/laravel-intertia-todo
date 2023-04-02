<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ArchivedTask extends Model {
  protected $table = 'archived_tasks';
  protected $guarded = [];
  protected $casts = [];
}
