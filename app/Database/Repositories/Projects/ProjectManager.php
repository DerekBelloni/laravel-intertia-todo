<?php

namespace App\Database\Repositories\Projects;

use Illuminate\Http\Request;
use App\Models\CheckList;
use App\Models\Project;
use App\Models\User;
use Inertia\Inertia;
use Carbon\Carbon;

class ProjectManager
{
  public static function store(Request $request)
  { 
    $project_name = $request->input('projectName');
    $user_id = Auth()->id();
    $team_members = User::where('id', $user_id)->first();
    // dd($team_members);


    Project::create([
      'project_name' => $project_name,
      'user_id' => $user_id,
      'team_members' => json_encode([
        'id' => $team_members['id'],
        'name' => $team_members['name'],
        'email' => $team_members['email']
      ])
    ]);

  }
}