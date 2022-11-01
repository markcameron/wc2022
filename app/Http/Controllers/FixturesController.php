<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixturesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Fixtures', [
            'fixtures' => Fixture::with(['homeTeam', 'awayTeam'])->orderBy('date')->get(),
        ]);
    }

    public function show(Request $request, Fixture $fixture)
    {
        $fixture->load(['homeTeam', 'awayTeam', 'venue']);

        return Inertia::render('FixtureDetail', [
            'fixture' => $fixture,
        ]);
    }
}
