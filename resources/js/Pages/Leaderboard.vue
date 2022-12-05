<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import { ref } from 'vue';

defineProps({
    users: Array,
});

const showStats = ref(false);

</script>

<template>
    <AppLayout title="Leaderboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leaderboard
            </h2>
        </template>

        <div class="py-2 px-4">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                <div class="py-2 flex justify-end">
                    <SwitchGroup>
                        <SwitchLabel passive class="mr-2 font-bold font-xl text-white">Show stats</SwitchLabel>
                        <Switch v-model="showStats" :class="[showStats ? 'bg-wc-lighter' : 'bg-wc-lightest', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-wc-lighter focus:ring-offset-2']">
                            <span class="sr-only">Use setting</span>
                            <span aria-hidden="true" :class="[showStats ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                    </SwitchGroup>
                </div>

                <div class="bg-white rounded-lg py-2">
                    <div v-for="(user, position) in users" class="border-b border-gray-300 last:border-b-0">
                        <div class="py-4 pr-4 py-2 flex items-center">
                            <div class="w-8 mx-1 flex-shrink-0 font-bold text-grey-900 text-2xl text-center">{{ position + 1 }}</div>
                            <div class="mr-2 bg-{{ user.background_color }} w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center">
                                <img :src="user.profile_photo_url" class="rounded-full" />
                            </div>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-900">{{ user.display_name }}</p>
                                <p class="text-sm text-gray-700">{{ user.catchphrase }}</p>
                                <p v-if="user.nickname" class="text-sm text-gray-700">{{ user.name }}</p>
                            </div>
                            <div class="w-14 flex-shrink-0 text-2xl font-bold text-right">
                                {{ user.score }}
                            </div>
                        </div>
                        <div :class="[showStats ? 'h-12' : 'h-0']" class="transition-height duration-200 ease-in-out origin-top overflow-hidden">
                            <div class="py-1 flex items-center justify-around bg-wc-lightest border-wc-lighter overflow-hidden">
                                <div class="flex flex-col">
                                    <div class="flex justify-center font-bold">{{ user.stats.exact_score.length }}</div>
                                    <div class="flex justify-center tracking-tight uppercase text-xs">Exact Score</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex justify-center font-bold">{{ user.stats.goal_difference.length }}</div>
                                    <div class="flex justify-center tracking-tight uppercase text-xs">Goal Difference</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex justify-center font-bold">{{ user.stats.winner.length }}</div>
                                    <div class="flex justify-center tracking-tight uppercase text-xs">Winner</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex justify-center font-bold">{{ user.stats.loser.length }}</div>
                                    <div class="flex justify-center tracking-tight uppercase text-xs">Loser</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
