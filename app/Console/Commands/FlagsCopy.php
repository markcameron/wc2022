<?php

namespace App\Console\Commands;

use App\Models\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FlagsCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flags:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy flags from npm package to public folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $teams = Team::get();

        $teams->each(function ($team) {
            $flag = Storage::disk('node_modules')->get('svg-country-flags/png100px/' . $team->flag_code . '.png');
            if ($flag) {
                Storage::disk('local')->put('flags/' . $team->flag_code . '.png', $flag);
            } else {
                dump($team->flag_code);
            }
        });

        return Command::SUCCESS;
    }
}
