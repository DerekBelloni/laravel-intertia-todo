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
        :class="[
        'rounded',
        'border-2',
        'border-rose-200',
        'bg-rose-100',
        'text-rose-300',
        'shadow-md',
        'focus:ring-rose-100',
        'h-3',
        'w-3',
    ]"
    />
</template>

<style>
    #custom-checkbox {
        border-radius: 50%;
    }
</style>
