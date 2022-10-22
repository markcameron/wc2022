<?php

namespace App\Console\Commands;

use App\Models\Team;
use Illuminate\Console\Command;
use App\Transporter\Requests\TeamsRequest;

class FootballApiFetchTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'football-api:teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve the teams from the Football API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = TeamsRequest::build()
            ->withQuery([
                'league' => 1,
                'season' => 2022,
            ])
            ->send()
            ->collect();

        collect($data->get('response'))->each(fn ($team) => $this->insertOrUpdate($team['team']));

        return Command::SUCCESS;
    }

    private function insertOrUpdate(array $team): void
    {
        Team::updateOrCreate([
            'id' => $team['id'],
            'name' => $team['name'],
            'code' => $team['code'],
        ]);
    }
}
