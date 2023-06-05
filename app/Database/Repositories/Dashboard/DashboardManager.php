<?php

namespace App\Database\Repositories\Dashboard;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WorkCheckList;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardManager
{
  public static function index(Request $request)
  {
    $user = Auth()->user();
   
    $tasks = WorkCheckList::where('user_id', Auth()->id())->get();

    $incomplete_tasks = 0;

    foreach ($tasks as $task) {
      if (!$task->task_completed) {
        $incomplete_tasks++;
      }
    }

    $current_date = Carbon::now()->tz('America/Denver');

    $day = $current_date->englishDayOfWeek;
    $month = $current_date->englishMonth;
    $date = $current_date->day;

    $current_hour = $current_date->hour;
    $time_of_day = '';

    if ($current_hour >= 6 && $current_hour < 12) {
      $time_of_day = 'morning';
    } else if ($current_hour >= 12 && $current_hour < 17) {
      $time_of_day = 'afternoon';
    } else if ($current_hour>= 17 && $current_hour < 20 ) {
      $time_of_day = 'evening';
    } else {
      $time_of_day = 'night';
    }

    $datetime_pieces = [
      'day' => $day,
      'month' => $month,
      'date' => $date
    ];
  
    // dd($user);
    return Inertia::render('Dashboard', [
      "user" => $user,
      "incomplete_tasks" => $incomplete_tasks,
      "datetime_pieces" => $datetime_pieces,
      "tasks" => $tasks,
      "time_of_day" => $time_of_day
    ]);
  }
}