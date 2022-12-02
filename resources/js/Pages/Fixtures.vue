<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Flag from '@/Components/Flag.vue';
    import { onMounted, onUnmounted } from 'vue';
    import moment from 'moment';
    import 'moment-timezone';
    import { Link } from '@inertiajs/inertia-vue3';
    import BannerDanger from '@/Components/BannerDanger.vue';
import { isIntegerKey } from '@vue/shared';

    defineProps({
        fixtures: Array,
        todaysFixtures: Array,
        missingPredictions: Number,
    });

    let div = null
    let scrollStorageKey = 'scroll-position-fixtures'

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
    <AppLayout title="Fixtures">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fixtures
            </h2>
        </template>

        <div class="py-2 px-4">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                <BannerDanger :show="missingPredictions">
                    <template v-if="(missingPredictions === 1)">You are missing {{ missingPredictions}} prediction for the next round</template>
                    <template v-else>You are missing {{ missingPredictions}} predictions for the next round</template>
                </BannerDanger>

                <div class="my-6">
                    <h3 class="mb-2 font-bold font-xl text-white">Today</h3>
                    <div v-for="fixture in todaysFixtures" class="mb-2 py-2 px-4 rounded-lg bg-white border border-white font-bold">
                        <Link :href="fixture.url">
                            <div class="flex flex-row">
                                <div class="mr-4 flex items-center"><Flag :code="fixture.home_team.flag" /></div>
                                <div class="flex flex-grow items-center">{{ fixture.home_team.name }}</div>
                                <div v-if="fixture.started" class="w-16 uppercase text-center">{{ fixture.goals_home.length }}</div>
                                <div v-else class="w-16 uppercase text-center">{{ moment(fixture.date).format('ddd D') }}</div>
                            </div>
                            <div class="flex flex-row">
                                <div class="mr-4 flex items-center"><Flag :code="fixture.away_team.flag" /></div>
                                <div class="flex flex-grow items-center">{{ fixture.away_team.name }}</div>
                                <div v-if="fixture.started" class="w-16 uppercase text-center">{{ fixture.goals_away.length }}</div>
                                <div v-else class="w-16 uppercase text-center">{{ moment.utc(fixture.date).tz('Europe/Zurich').format('HH:mm') }}</div>
                            </div>
                        </Link>
                    </div>
                </div>

                <div v-for="(stageFixtures, stage) in fixtures" class="my-6">
                    <h3 class="mb-2 font-bold font-xl text-white">{{ stage }}</h3>
                    <div v-for="fixture in stageFixtures" class="mb-2 py-2 px-4 rounded-lg bg-white border border-white font-bold">
                        <Link :href="fixture.url">
                            <div class="flex flex-row">
                                <div class="mr-4 flex items-center"><Flag :code="fixture.home_team.flag" /></div>
                                <div class="flex flex-grow items-center">{{ fixture.home_team.name }}</div>
                                <div v-if="fixture.started" class="w-16 uppercase text-center">{{ fixture.goals_home.length }}</div>
                                <div v-else class="w-16 uppercase text-center">{{ moment(fixture.date).format('ddd D') }}</div>
                            </div>
                            <div class="flex flex-row">
                                <div class="mr-4 flex items-center"><Flag :code="fixture.away_team.flag" /></div>
                                <div class="flex flex-grow items-center">{{ fixture.away_team.name }}</div>
                                <div v-if="fixture.started" class="w-16 uppercase text-center">{{ fixture.goals_away.length }}</div>
                                <div v-else class="w-16 uppercase text-center">{{ moment.utc(fixture.date).tz('Europe/Zurich').format('HH:mm') }}</div>
                            </div>
                        </Link>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
