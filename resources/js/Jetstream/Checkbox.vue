<template>
    <input type="checkbox" :value="value" v-model="proxyChecked"
           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
</template>

<script>
    export default {
        props: {
            modelValue: {
                type: [Array, Boolean],
                default: false,
            },
            value: {
                default: null,
            },
        },

        emits: ['update:modelValue'],

        computed: {
            proxyChecked: {
                get() {
                    return this.modelValue;
                },
                set(val) {
                    this.$emit('update:modelValue', val);
                },
            },
        },
    }
</script>

