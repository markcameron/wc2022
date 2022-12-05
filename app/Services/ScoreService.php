<?php

namespace App\Services;

use App\Models\User;
use App\Enums\ScoreType;
use App\Models\Prediction;
use Illuminate\Support\Collection;

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

    public function getLeaderboard(): Collection
    {
        $users = User::with(['predictions.fixture.events'])->get();

        $users = $users
            ->map(function ($user) {
                $userArray = $user->attributesToArray();
                $userArray['score'] = $this->getUserScore($user);
                $userArray['stats'] = $this->getUserStats($user);
                $userArray['sort'] = $user->leaderboard_sort;
                return $userArray;
            })
            ->sortByDesc('sort')
            ->values();

        return $users;
    }

    public function getPredictionStatus(?Prediction $prediction): ?string
    {
        if (is_null($prediction)) {
            return null;
        }

        if (!$prediction->fixture->started) {
            return null;
        }

        if ($this->predictedCorrectScore($prediction)) {
            return ScoreType::ExactScore->value;
        }

        if ($this->predictedCorrectDifference($prediction)) {
            return ScoreType::GoalDifference->value;
        }

        if ($this->predictedCorrectWinner($prediction)) {
            return ScoreType::Winner->value;
        }

        return ScoreType::Loser->value;
    }

    private function getPredictionPoints(Prediction $prediction): int
    {
        if (!$prediction->fixture->started) {
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
     * Check if the user predicted the correct score of the fixture
     *
     * @param Prediction $prediction
     * The prediction Eloquent object
     *
     * @return bool
     * TRUE if prediction is correct, otherwise FALSE
     */
    private function predictedCorrectScore(Prediction $prediction): bool
    {
        return $prediction->score_home === $prediction->fixture->goals_home->count()
            && $prediction->score_away === $prediction->fixture->goals_away->count();
    }

    /**
     * Check if the user predicted the correct goal difference of the fixture
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
        $match_difference = $prediction->fixture->goals_home->count() - $prediction->fixture->goals_away->count();

        return $predicted_difference === $match_difference;
    }

    /**
     * Check if the user predicted the correct winner of the fixture
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
        $match_difference = $prediction->fixture->goals_home->count() - $prediction->fixture->goals_away->count();

        return $predicted_difference < 0 && $match_difference < 0
            || $predicted_difference > 0 && $match_difference > 0;
    }
}
