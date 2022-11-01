<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia'
import moment from 'moment';
import 'moment-timezone';
import CountryFlag from 'vue-country-flag-next';
import { Link } from '@inertiajs/inertia-vue3';
import Back from '@/Components/Back.vue';

defineProps({
    fixture: Object,
    users: Array,
});

const back = () => {
    Inertia.visit(url, { preserveScroll: true })
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fixture Detail
            </h2>
        </template>

        <Back href="/fixtures">back</Back>

        <div class="py-4 px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white rounded-lg">

                    <div class="p-4">
                        <p class="mb-2 uppercase tracking-wide text-sm font-bold text-gray-700">{{ moment.utc(fixture.date).tz('Europe/Zurich').format('dddd MMMM Do - HH:mm') }}</p>
                        <div class="text-3xl text-gray-900 flex flex-row">
                            <div class="mr-4 flex items-center"><CountryFlag :country="fixture.home_team.code" /></div>
                            <div class="flex-grow">{{ fixture.home_team.name }}</div>
                            <div class="w-8">{{ fixture.started ? fixture.score_home : '' }}</div>
                        </div>
                        <div class="text-3xl text-gray-900 flex flex-row">
                            <div class="mr-4 flex items-center"><CountryFlag :country="fixture.away_team.code" /></div>
                            <div class="flex-grow">{{ fixture.away_team.name }}</div>
                            <div class="w-8">{{ fixture.started ? fixture.score_away : '' }}</div>
                        </div>
                        <p class="mt-2 text-gray-500 tracking-tighter uppercase text-sm">{{ fixture.venue.name }} - {{ fixture.venue.city }}</p>
                    </div>

                    <div v-if="fixture.started" class="border-t border-gray-300 rounded-b-lg">
                        <div v-for="user in users" class="flex items-center px-2 py-2 border-b border-gray-300 last:border-b-0">
                            <div class="mr-2 bg-{{ user.background_color }} w-10 h-10 flex-shrink-0 rounded-full flex items-center justify-center">
                                <img :src="user.info.profile_photo_url" class="rounded-full" />
                            </div>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-900">{{ user.info.name }}</p>
                            </div>
                            <template v-if="user.prediction">
                                <div class="w-14 flex-shrink-0 text-2xl font-bold">
                                    {{ user.prediction.score_home }} - {{ user.prediction.score_away }}
                                </div>
                                <div class="bg-cover bg-center w-8 h-8 flex-shrink-0 rounded-full ml-2">
                                    prediction-icon
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
