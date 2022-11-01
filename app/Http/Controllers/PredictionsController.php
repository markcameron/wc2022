<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Fixture;
use App\Models\Prediction;
use Illuminate\Http\Request;

class PredictionsController extends Controller
{
    public function index(Request $request)
    {
        $fixtures = Fixture::with(['homeTeam', 'awayTeam', 'userPrediction'])->get();

        return Inertia::render('Predictions', [
            'fixtures' => $fixtures,
            'todaysFixtures' => $fixtures->whereBetween('date', [now()->startOfDay(), now()->endOfDay()]),
        ]);
    }

    public function show(Request $request, Fixture $fixture)
    {
        $prediction = Prediction::firstOrCreate([
            'user_id' => auth()->user()->id,
            'fixture_id' => $fixture->id,
        ]);

        $prediction->load(['fixture.homeTeam', 'fixture.awayTeam', 'fixture.venue']);
        // dd($prediction);
        // $fixture->load(['homeTeam', 'awayTeam', 'venue', 'userPrediction']);

        return Inertia::render('PredictionDetail', [
            'prediction' => $prediction,
        ]);
    }

    public function decreaseScore(Request $request)
    {
        $fixtureId = $request->fixture_id;
        // $team = $request->team;

        $prediction = Prediction::where('user_id', auth()->user()->id)
            ->where('fixture_id', $fixtureId)
            ->first();

        $prediction->decreaseScore($request->team);

        $prediction->load(['fixture.homeTeam', 'fixture.awayTeam', 'fixture.venue']);

        return Inertia::render('PredictionDetail', [
            'prediction' => $prediction,
        ]);
    }

    public function increaseScore(Request $request)
    {
        $fixtureId = $request->fixture_id;

        $prediction = Prediction::where('user_id', auth()->user()->id)
            ->where('fixture_id', $fixtureId)
            ->first();

        $prediction->increaseScore($request->team);

        $prediction->load(['fixture.homeTeam', 'fixture.awayTeam', 'fixture.venue']);

        return Inertia::render('PredictionDetail', [
            'prediction' => $prediction,
        ]);
    }
}
