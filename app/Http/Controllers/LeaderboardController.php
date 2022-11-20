<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['predictions.fixture.events'])->get();

        $users->transform(fn($user) => $user->append('score'));

        return Inertia::render('Leaderboard', [
            'users' => $users->sortByDesc('score')->values(),
        ]);
    }
}
