<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    users: Array,
});
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
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
