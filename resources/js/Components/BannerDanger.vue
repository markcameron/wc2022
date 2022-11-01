<script setup>
const props = defineProps({
    show: Boolean,
});
</script>

<template>
    <div v-if="show" class="flex items-center text-white max-w-sm w-full bg-red-400 shadow-md rounded-lg overflow-hidden mx-auto mb-4">
        <div class="w-10 border-r px-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01">
                </path>
            </svg>
        </div>

        <div class="flex items-center px-2 py-3">
            <div class="mx-3">
                <p><slot /></p>
            </div>
        </div>
    </div>
</template>