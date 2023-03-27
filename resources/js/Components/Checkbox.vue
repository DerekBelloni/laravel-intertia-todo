<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        // type: [Array, Boolean],
        type: Boolean,
        required: false,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        console.log('child component get: ', props.checked);
        return props.checked;
    },

    set(val) {
        // val = !val;
        console.log('child component set: ', val);
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded border-gray-300 text-teal-300 shadow-sm focus:ring-teal-100"
    />
</template>
