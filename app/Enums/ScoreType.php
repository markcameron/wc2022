<?php

namespace App\Enums;

enum ScoreType: string
{
    case ExactScore = 'exact_score';
    case GoalDifference = 'goal_difference';
    case Winner = 'winner';
    case Loser = 'loser';
}
