<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'flex items-center p-1 text-sm font-bold text-slate-700 rounded-sm bg-slate-200 group transition duration-150 ease-in-out'
        : 'flex items-center p-1 text-sm font-light text-slate-700 rounded-sm hover:bg-slate-100 group transition duration-150 ease-in-out'
});

</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
