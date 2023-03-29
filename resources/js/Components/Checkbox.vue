<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

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
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        id="custom-checkbox"
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded border-gray-300 text-teal-300 shadow-sm focus:ring-teal-100"
    />
</template>

<style>
    #custom-checkbox {
        border-radius: 50%;
    }
</style>
