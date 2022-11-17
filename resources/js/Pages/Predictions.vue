<script setup>
    import { onMounted, onUnmounted } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Flag from '@/Components/Flag.vue';
    import 'moment-timezone';
    import { Link } from '@inertiajs/inertia-vue3';

    defineProps({
        fixtures: Array,
    });

    let div = null
    let scrollStorageKey = 'scroll-position-predictions'

    onMounted(() => {
        div = document.getElementById('scrollable')
        if (div.clientHeight !== 0 && localStorage.getItem(scrollStorageKey) != null) {
            div.scrollTop = parseInt(localStorage.getItem(scrollStorageKey));
        }
        div.addEventListener('scroll', handleScroll)
    });
    onUnmounted(() => div.removeEventListener('scroll', handleScroll));

    const handleScroll = (event) => {
        localStorage.setItem(scrollStorageKey, div.scrollTop);
    };
</script>

<template>
    <AppLayout title="Predictions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Predictions
            </h2>
        </template>

        <div class="py-2 px-4">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                <div v-for="fixture in fixtures"
                    class="mb-2 py-2 px-4 rounded-lg bg-white border border-white font-bold"
                    :class="{ 'bg-white': fixture.can_predict, 'bg-rose-50 border-l-8 border-orange-300': !fixture.can_predict }"
                >
                    <Link :href="fixture.url_prediction">
                        <div class="flex flex-row">
                            <div class="mr-4 flex items-center"><Flag :code="fixture.home_team.flag" /></div>
                            <div class="flex flex-grow items-center">{{ fixture.home_team.name }}</div>
                            <div class="w-16 uppercase text-center">{{ fixture.user_prediction ? fixture.user_prediction.score_home : '-' }}</div>
                        </div>
                        <div class="flex flex-row">
                            <div class="mr-4 flex items-center"><Flag :code="fixture.away_team.flag" /></div>
                            <div class="flex flex-grow items-center">{{ fixture.away_team.name }}</div>
                            <div class="w-16 uppercase text-center">{{ fixture.user_prediction ? fixture.user_prediction.score_away : '-' }}</div>
                        </div>
                    </Link>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
