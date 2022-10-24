<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import moment from 'moment';
import CountryFlag from 'vue-country-flag-next';

defineProps({
    fixtures: Array,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fixtures
            </h2>
        </template>

        <div class="py-12 px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
                <div v-for="fixture in fixtures" class="mb-2 py-2 px-4 rounded-lg bg-white border border-white dark:bg-gray-900 dark:border-gray-800 font-bold">
                    <div class="flex flex-row">
                        <div class="mr-4 flex items-center"><CountryFlag :country="fixture.home_team.code" /></div>
                        <div class="flex flex-grow items-center">{{ fixture.home_team.name }}</div>
                        <div class="w-16 uppercase text-center">{{ moment(fixture.date).format('ddd D') }}</div>
                    </div>
                    <div class="flex flex-row">
                        <div class="mr-4 flex items-center"><CountryFlag :country="fixture.away_team.code" /></div>
                        <div class="flex flex-grow items-center">{{ fixture.away_team.name }}</div>
                        <div class="w-16 uppercase text-center">{{ moment(fixture.date).format('HH:mm') }}</div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
