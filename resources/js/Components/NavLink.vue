<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'w-full items-center text-wc-darker focus:text-wc-darkest hover:text-wc-darker justify-center inline-block text-center pt-2 pb-1 border-b-4 border-wc-darker flex flex-col focus:outline-none focus:border-wc-darkest transition' /* inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition */
        : 'w-full items-center text-white focus:text-wc-darkest hover:text-wc-darker justify-center inline-block text-center pt-2 pb-1 flex flex-col'; /* inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition */
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
