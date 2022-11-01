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
                        <p class="mb-2 uppercase tracking-wide text-sm font-bold text-gray-700">{{ moment.utc(fixture.date).tz('Europe/Zurich').format('ddd D - HH:mm') }}</p>
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
                </div>

            </div>
        </div>

    </AppLayout>
</template>
