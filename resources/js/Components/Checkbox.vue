<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
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
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        :class="[
        // 'rounded',
        'border-2',
        'border-rose-200',
        'bg-rose-100',
        'text-rose-300',
        'shadow-md',
        'focus:ring-rose-100',
        'h-3',
        'w-3',
        ]"
        class="rounded-xl"
        />
</template>
