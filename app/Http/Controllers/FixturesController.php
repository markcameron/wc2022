<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixturesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Fixtures', [
            'fixtures' => Fixture::with(['homeTeam', 'awayTeam'])->orderBy('date')->get()->groupBy('stage')->reverse(),
            'todaysFixtures' => Fixture::with(['homeTeam', 'awayTeam'])->whereDate('date', now()->toDateString())->orderBy('date')->get(),
            'missingPredictions' => $request->user()->missing_predictions_count,
        ]);
    }

    public function show(Request $request, Fixture $fixture)
    {
        $fixture->load(['homeTeam', 'awayTeam', 'venue', 'goals']);

        return Inertia::render('FixtureDetail', [
            'fixture' => $fixture,
            'users' => User::get()->map(fn($user) => [
                'info' => $user,
                'prediction' => $user->prediction($fixture),
                'predictionState' => $user->predictionState($fixture),
            ]),
        ]);
    }
}
