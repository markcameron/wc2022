<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import moment from 'moment';
import 'moment-timezone';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    fixtures: Array,
});
</script>

<template>
    <AppLayout title="Fixtures">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fixtures
            </h2>
        </template>

        <div class="py-8 px-4">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    
                <div v-for="fixture in fixtures" class="mb-2 py-2 px-4 rounded-lg bg-white border border-white dark:bg-gray-900 dark:border-wc-lightest font-bold">
                    <Link :href="fixture.url">
                        <div class="flex flex-row">
                            <div class="mr-4 flex items-center" v-html="fixture.home_team.flag"></div>
                            <div class="flex flex-grow items-center">{{ fixture.home_team.name }}</div>
                            <div class="w-16 uppercase text-center">{{ moment(fixture.date).format('ddd D') }}</div>
                        </div>
                        <div class="flex flex-row">
                            <div class="mr-4 flex items-center" v-html="fixture.away_team.flag"></div>
                            <div class="flex flex-grow items-center">{{ fixture.away_team.name }}</div>
                            <div class="w-16 uppercase text-center">{{ moment.utc(fixture.date).tz('Europe/Zurich').format('HH:mm') }}</div>
                        </div>
                    </Link>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
