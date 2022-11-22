<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Fixture;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Transporter\Requests\FixtureEventsRequest;

class FootballApiFetchFixturesEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'football-api:fixture-events {--a|all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get events for active fixtures';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::transaction(function () {
            $this->activeFixtures()
                ->each(fn ($fixture) => $this->info('Active Fixture: ' . $fixture->id . ' | ' . $fixture->homeTeam->name . ' v ' . $fixture->awayTeam->name))
                ->map(fn ($fixture) => $this->fetchFixtureEvents($fixture))
                ->each(fn ($fixtureEvents) => $this->deleteFixtureEvents($fixtureEvents))
                ->each(fn ($fixtureEvents) => $this->updateEvents($fixtureEvents))
                ;
        });

        return Command::SUCCESS;
    }

    private function activeFixtures(): Collection
    {
        if ($this->option('all')) {
            return Fixture::where('date', '<', now())->get();
        }

        return Fixture::whereBetween('date', [now()->subHours(3), now()])->get();
    }

    private function fetchFixtureEvents(Fixture $fixture): Collection
    {
        return FixtureEventsRequest::build()
            ->withQuery([
                'fixture' => $fixture->id,
            ])
            ->send()
            ->collect();
    }

    private function deleteFixtureEvents(Collection $fixtureEvents): void
    {
        Event::where('fixture_id', $fixtureEvents->get('parameters')['fixture'])->delete();
    }

    private function updateEvents(Collection $fixtureEvents): void
    {
        collect($fixtureEvents->get('response'))
            ->each(fn ($event) => $this->upsertEvent($event, $fixtureEvents->get('parameters')['fixture']));
    }

    private function upsertEvent(array $event, int $fixtureId): void
    {
        Event::create([
            'fixture_id' => $fixtureId,
            'team_id' => $event['team']['id'],
            'type' => $event['type'],
            'time_elapsed' => $event['time']['elapsed'],
            'time_extra' => $event['time']['extra'],
            'player_id' => $event['player']['id'],
            'player_name' => $event['player']['name'],
            'assist_id' => $event['assist']['id'],
            'assist_name' => $event['assist']['name'],
            'detail' => $event['detail'],
            'comments' => $event['comments'],
        ]);

    }
}
