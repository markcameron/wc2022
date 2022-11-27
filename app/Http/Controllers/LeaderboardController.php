<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ScoreService;
use Inertia\Inertia;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Leaderboard', [
            'users' => resolve(ScoreService::class)->getLeaderboard(),
        ]);
    }
}
