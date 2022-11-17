<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Rules">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rules
            </h2>
        </template>

        <div class="m-4">

            <div class="mb-2 py-4 px-4 rounded-lg bg-white border border-white">

                <h1 class="text-2xl mb-4 font-bold">Rules</h1>
                <h2 class="text-xl mb-2 font-bold">Predictions</h2>
                <p class="mb-2">For all group stage predictions, you must have predicted all results by kick off of the first game (November 20th 2022, 1700 CET).</p>
                <p class="mb-2">For the knockout round, predictions need only be in by kick off of the game in question.</p>

                <h2 class="text-xl mt-6 mb-2 font-bold">Scoring</h2>
                <p class="mb-2">The break down of points awarded is as follows:</p>

                <ul class="list-disc ml-6">
                    <li>
                        <h3 class="font-bold">5 points</h3>
                        <p class="mb-2">For guessing the exact score and result of a match</p>
                    </li>
                    <li>
                        <h3 class="font-bold">3 points</h3>
                        <p class="mb-2">For guessing the exact goal difference and result of a match</p>
                    </li>
                    <li>
                        <h3 class="font-bold">2 points</h3>
                        <p class="mb-2">For guessing the correct winner of a match</p>
                    </li>
                </ul>

                <h2 class="text-xl mt-6 mb-2 font-bold">Knockout stages</h2>

                <p class="mb-2">Predictions for knockout games need ony be made by kick off of the game in question.</p>
                <p class="mb-2">The score you predict is the result at the end of the game, be it 90 minutes or 120 should it go to extra time. Should the game be a draw after extra time, the penalites are not included in your prediction.</p>

            </div>

        </div>
    </AppLayout>
</template>
