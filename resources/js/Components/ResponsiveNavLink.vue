<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block pl-3 pr-4 py-2 border-l-4 border-wc-darkest text-base font-medium text-wc-darker bg-wc-lightest focus:outline-none focus:text-wc-light focus:bg-wc-darkest focus:border-wc-darker transition'
        : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-wc-lightest hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-wc-light focus:bg-wc-darkest focus:border-wc-darker transition';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
