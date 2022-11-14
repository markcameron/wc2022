<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-wc-darker">
        <div>
            <slot name="logo" />
        </div>

        <div class="px-4 py-8">
            <div class="mx-auto">
                <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
                    <slot />
                </div>
            </div>
        </div>

    </div>
</template>
