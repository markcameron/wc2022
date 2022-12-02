<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use Illuminate\Console\Command;

class ClosePredictionsWhenFixtureBegins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predictions:close-on-kickoff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close predictions for any matches that have started';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Fixture::where('can_predict', 1)
            ->where('date', '<', now()->toDateTimeString())
            ->update([
                'can_predict' => false,
            ]);

        return Command::SUCCESS;
    }
}
