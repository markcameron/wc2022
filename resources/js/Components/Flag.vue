<script setup>
const props = defineProps({
    code: String,
    width: {
        type: String,
        default: 'w-6',
    },
    height: {
        type: String,
        default: 'h-4',
    },
});

const flagUrl = () => '/images/flags/' + props.code + '.png';

</script>

<template>
    <div class="flex justify-center" :class="[width, height]">
        <img :src="flagUrl()" class="object-cover" :class="[height]" />
    </div>
</template>