<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <jet-application-mark class="block h-20 w-20" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    export default {
        components: {
            JetApplicationMark,
        }
    }
</script>
