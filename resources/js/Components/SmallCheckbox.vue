<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:small-checked']);

const props = defineProps({
    checked: {
        type: Boolean,
        required: false,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        console.log('val: ', val)
        emit('update:small-checked', val);
    },
});
</script>

<template>
    <input
        id="custom-checkbox"
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded border-2 border-emerald-200 bg-emerald-100 text-emerald-300 shadow-md focus:ring-emerald-100 h-3 w-3"
    />
</template>

<style>
    #custom-checkbox {
        border-radius: 50%;
    }
</style>
