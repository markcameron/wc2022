<template>
    <div class="min-h-screen flex flex-col sm:justify-center pt-6 sm:pt-0 bg-wc-darker">
        <div class="py-10 flex justify-center">
            <slot name="logo" />
        </div>

        <div class="px-4 py-8 flex justify-center w-full">
            <div class="mx-auto">
                <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
                    <slot />
                </div>
            </div>
        </div>

    </div>
</template>
