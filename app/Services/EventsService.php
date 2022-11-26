<?php

namespace App\Services;

use App\Models\Fixture;
use App\Models\Event;
use App\Transporter\Requests\FixtureEventsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class EventsService
{
    private bool $allFixtures = false;
    private ?Fixture $specificFixture = null;

    public function all(): self
    {
        $this->allFixtures = true;

        return $this;
    }

    public function fixture(Fixture $fixture): self
    {
        $this->specificFixture = $fixture;

        return $this;
    }

    public function handle(): bool
    {
        DB::transaction(function () {
            $this->activeFixtures()
                //->each(fn ($fixture) => $this->info('Active Fixture: ' . $fixture->id . ' | ' . $fixture->homeTeam->name . ' v ' . $fixture->awayTeam->name))
                ->map(fn ($fixture) => $this->fetchFixtureEvents($fixture))
                ->each(fn ($fixtureEvents) => $this->deleteFixtureEvents($fixtureEvents))
                ->each(fn ($fixtureEvents) => $this->updateEvents($fixtureEvents))
                ;
        });

        return true;
    }

    private function activeFixtures(): Collection
    {
        if ($this->allFixtures) {
            return Fixture::where('date', '<', now())->get();
        }

        if ($this->specificFixture) {
            return collect()->push($this->specificFixture);
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
