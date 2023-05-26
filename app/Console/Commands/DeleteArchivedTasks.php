<?php

namespace App\Console\Commands;

use App\Models\ArchivedTask;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DeleteArchivedTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-archived-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current_date = new Carbon();

        $archived_tasks = ArchivedTask::get();

        foreach ($archived_tasks as $task) {
            if ($current_date->diffInDays($task['created_at']) > 30) {
                $task->delete();
            }
        }

    }
}
