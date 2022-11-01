<?php

namespace App\Services;

use App\Models\Prediction;
use App\Models\User;

class ScoreService
{

    const POINTS_CORRECT_SCORE = 5;
    const POINTS_CORRECT_DIFFERENCE = 3;
    const POINTS_CORRECT_WINNER = 2;
    const POINTS_WRONG = 0;

    public function getUserScore(User $user): int
    {
        return $user->predictions->reduce(fn($carry, $prediction) => $carry + $this->getPredictionPoints($prediction), 0);
    }

    public function getUserStats(User $user)
    {
        return $user->predictions->mapToGroups(fn($prediction) => [$this->getPredictionStatus($prediction) => 1])->filter();
    }

    public function getPredictionStatus(Prediction $prediction): ?string
    {
        if (!$prediction->game->started) {
            return null;
        }

        if ($this->predictedCorrectScore($prediction)) {
            return Prediction::EXACT_SCORE;
        }

        if ($this->predictedCorrectDifference($prediction)) {
            return Prediction::GOAL_DIFFERENCE;
        }

        if ($this->predictedCorrectWinner($prediction)) {
            return Prediction::WINNER;
        }

        return Prediction::LOSER;
    }

    private function getPredictionPoints(Prediction $prediction): int
    {
        if (!$prediction->game->started) {
            return 0;
        }

        if ($this->predictedCorrectScore($prediction)) {
            return self::POINTS_CORRECT_SCORE;
        }

        if ($this->predictedCorrectDifference($prediction)) {
            return self::POINTS_CORRECT_DIFFERENCE;
        }

        if ($this->predictedCorrectWinner($prediction)) {
            return self::POINTS_CORRECT_WINNER;
        }

        return self::POINTS_WRONG;
    }

    /**
     * Check if the user predicted the correct score of the game
     *
     * @param Prediction $prediction
     * The prediction Eloquent object
     *
     * @return bool
     * TRUE if prediction is correct, otherwise FALSE
     */
    private function predictedCorrectScore(Prediction $prediction): bool
    {
        return $prediction->score_home === $prediction->game->score_home
            && $prediction->score_away === $prediction->game->score_away;
    }

    /**
     * Check if the user predicted the correct goal difference of the game
     *
     * @param Prediction $prediction
     * The prediction Eloquent object
     *
     * @return bool
     * TRUE if prediction is correct, otherwise FALSE
     */
    private function predictedCorrectDifference(Prediction $prediction): bool
    {
        if ($prediction->hasNoScore()) {
            return false;
        }

        $predicted_difference = $prediction->score_home - $prediction->score_away;
        $match_difference = $prediction->game->score_home - $prediction->game->score_away;

        return $predicted_difference === $match_difference;
    }

    /**
     * Check if the user predicted the correct winner of the game
     *
     * @param Prediction $prediction
     * The prediction Eloquent object
     *
     * @return bool
     * TRUE if prediction is correct, otherwise FALSE
     */
    private function predictedCorrectWinner(Prediction $prediction): bool
    {
        if ($prediction->hasNoScore()) {
            return false;
        }

        $predicted_difference = $prediction->score_home - $prediction->score_away;
        $match_difference = $prediction->game->score_home - $prediction->game->score_away;

        return $predicted_difference < 0 && $match_difference < 0
            || $predicted_difference > 0 && $match_difference > 0;
    }
}
