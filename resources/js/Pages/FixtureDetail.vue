<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia'
import moment from 'moment';
import 'moment-timezone';
import Back from '@/Components/Back.vue';
import Flag from '@/Components/Flag.vue';

defineProps({
    fixture: Object,
    users: Array,
});

const back = () => {
    Inertia.visit(url, { preserveScroll: true })
}
</script>

<template>
    <AppLayout title="Fixture Detail">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fixture Detail
            </h2>
        </template>

        <Back :href="route('fixtures')">back</Back>

        <div class="py-2 px-4">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white rounded-lg">

                    <div class="p-4">
                        <p class="mb-2 uppercase tracking-wide text-sm font-bold text-gray-700">{{ moment.utc(fixture.date).tz('Europe/Zurich').format('dddd MMMM Do - HH:mm') }}</p>
                        <div class="text-3xl text-gray-900 flex flex-row">
                            <div class="mr-3 flex items-center"><Flag :code="fixture.home_team.flag" width="w-10" height="h-7" /></div>
                            <div class="flex-grow">{{ fixture.home_team.name }}</div>
                            <div class="w-8">{{ fixture.started ? fixture.goals_home.length : '' }}</div>
                        </div>
                        <div class="text-3xl text-gray-900 flex flex-row">
                            <div class="mr-3 flex items-center"><Flag :code="fixture.away_team.flag" width="w-10" height="h-7" /></div>
                            <div class="flex-grow">{{ fixture.away_team.name }}</div>
                            <div class="w-8">{{ fixture.started ? fixture.goals_away.length : '' }}</div>
                        </div>
                        <p class="mt-2 text-gray-500 tracking-tighter uppercase text-sm">{{ fixture.venue.name }} - {{ fixture.venue.city }}</p>
                    </div>

                    <div v-if="fixture.goals.length" class="border-t py-2 bg-gray-100 border-gray-300">
                        <div v-for="goal in fixture.goals" class="px-2 py-1 border-b border-gray-200 last:border-b-0 flex flex-row">
                            <div class="flex-1 font-bold">{{ goal.team_id === fixture.home_team_id ? goal.player_name : '' }}</div>
                            <div class="w-10 text-center font-bold">{{ goal.time_elapsed }}'</div>
                            <div class="flex-1 font-bold text-right">{{ goal.team_id === fixture.away_team_id ? goal.player_name : '' }}</div>
                        </div>
                    </div>

                    <div v-if="fixture.started" class="border-t border-gray-300 rounded-b-lg">
                        <div v-for="user in users" class="flex items-center px-2 py-2 border-b border-gray-300 last:border-b-0">
                            <div class="mr-2 bg-{{ user.background_color }} w-10 h-10 flex-shrink-0 rounded-full flex items-center justify-center">
                                <img :src="user.info.profile_photo_url" class="rounded-full" />
                            </div>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-900">{{ user.info.display_name }}</p>
                            </div>
                            <template v-if="user.prediction">
                                <div class="w-14 flex-shrink-0 text-2xl font-bold">
                                    {{ user.prediction.score_home }} - {{ user.prediction.score_away }}
                                </div>
                                <div class="bg-cover w-8 h-8 flex flex-shrink-0 rounded-full ml-2 items-center">
                                    <div v-if="user.predictionState === 'exact_score'" class="text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                        </svg>
                                    </div>
                                    <div v-if="user.predictionState === 'goal_difference'" class="text-cyan-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                        </svg>
                                    </div>
                                    <div v-if="user.predictionState === 'winner'" class="text-fuchsia-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <div v-if="user.predictionState === 'loser'" class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="w-24 flex justify-center">
                                    <span class="bg-red-500 text-white font-bold px-2 py-1 rounded-lg">FAIL</span>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div v-else class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-200 text-center rounded-b-lg">
                        <p>User predictions will appear after kick-off</p>
                    </div>

                </div>

            </div>
        </div>

    </AppLayout>
</template>
