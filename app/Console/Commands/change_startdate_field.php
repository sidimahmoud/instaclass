<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CourseFile;

class change_startdate_field extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insta:change-files-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = CourseFile::all();

        foreach($files as $file) {
           $this->info($file->startDate);

           $file->update([
                "startDate" => substr($file->startDate, 0, 10) . ' '. substr($file->startDate, 11, 8)
           ]);
        }

        return 0;
    }
}
