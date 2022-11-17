<script setup>
const props = defineProps({
    code: String,
});

const flagUrl = () => '/images/flags/' + props.code + '.png';

</script>

<template>
    <div class="flex justify-center w-6 h-4">
        <img :src="flagUrl()" class="object-cover h-4" />
    </div>
</template>