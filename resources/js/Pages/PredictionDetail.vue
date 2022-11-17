<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia'
import moment from 'moment';
import 'moment-timezone';
import Back from '@/Components/Back.vue';
import BannerDanger from '@/Components/BannerDanger.vue';
import Flag from '@/Components/Flag.vue';
import { MinusIcon } from '@heroicons/vue/24/solid';
import { PlusIcon } from '@heroicons/vue/24/solid';

defineProps({
    prediction: Object,
});

const decreaseScore = (prediction, team) => {
    Inertia.put(route('predictions.decrease_score'), {
        fixture_id: prediction.fixture.id,
        team: team,
    }, {
        preserveState: false,
    });
};

const increaseScore = (prediction, team) => {
    Inertia.put(route('predictions.increase_score'), {
        fixture_id: prediction.fixture.id,
        team: team,
    }, {
        preserveState: false,
    });
};
</script>

<template>
    <AppLayout title="Prediction Detail">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Prediction Detail
            </h2>
        </template>

        <Back :href="route('predictions')">back</Back>

        <div class="py-8 px-4">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white rounded-lg">
                    <div class="p-4">

                        <BannerDanger :show="!prediction.fixture.can_predict">Predictions for this match are closed</BannerDanger>

                        <p class="mb-2 uppercase tracking-wide text-sm font-bold text-gray-700">{{ moment.utc(prediction.fixture.date).tz('Europe/Zurich').format('dddd MMMM Do - HH:mm') }}</p>
                        <div class="text-3xl text-gray-900 flex flex-row">
                            <div class="mr-4 flex items-center"><Flag :code="prediction.fixture.home_team.flag" /></div>
                            <div class="flex-grow">{{ prediction.fixture.home_team.name }}</div>
                            <div v-if="prediction.fixture.can_predict" class="w-8 flex items-center justify-center" @click="decreaseScore(prediction, 'home')">
                                <MinusIcon class="h-8 w-8 text-wc-dark"></MinusIcon>
                            </div>
                            <div class="w-8 flex justify-center">
                                {{ prediction.score_home }}
                            </div>
                            <div v-if="prediction.fixture.can_predict" class="w-8 flex items-center justify-center" @click="increaseScore(prediction, 'home')">
                                <PlusIcon class="h-8 w-8 text-wc-dark"></PlusIcon>
                            </div>
                        </div>
                        <div class="text-3xl text-gray-900 flex flex-row">
                            <div class="mr-4 flex items-center"><Flag :code="prediction.fixture.away_team.flag" /></div>
                            <div class="flex-grow">{{ prediction.fixture.away_team.name }}</div>
                            <div v-if="prediction.fixture.can_predict" class="w-8 flex items-center justify-center" @click="decreaseScore(prediction, 'away')">
                                <MinusIcon class="h-8 w-8 text-wc-dark"></MinusIcon>
                            </div>
                            <div class="w-8 flex justify-center">
                                {{ prediction.score_away }}
                            </div>
                            <div v-if="prediction.fixture.can_predict" class="w-8 flex items-center justify-center" @click="increaseScore(prediction, 'away')">
                                <PlusIcon class="h-8 w-8 text-wc-dark"></PlusIcon>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-500 tracking-tighter uppercase text-sm">{{ prediction.fixture.venue.name }} - {{ prediction.fixture.venue.city }}</p>
                    </div>
                </div>

            </div>
        </div>

    </AppLayout>
</template>
