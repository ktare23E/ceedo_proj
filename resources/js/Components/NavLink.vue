<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'group flex items-center gap-3 py-3 px-6  bg-purple-500 text-white hover:bg-purple-50 hover:text-purple-700 transition-all duration-200 relative overflow-hidden'
        : 'group flex items-center gap-3 py-3 px-6 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-all duration-200 relative overflow-hidden',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
