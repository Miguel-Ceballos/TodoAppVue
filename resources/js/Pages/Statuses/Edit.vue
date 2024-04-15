<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import StatusesForm from "@/Components/Statuses/StatusesForm.vue";

const props = defineProps({
    status: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: props.status.name
})

</script>

<template>
    <AppLayout title="Statuses">
        <template #header>
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Update Status
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <StatusesForm :form="form" @submit="form.put(route('statuses.update', status))" :updating="true"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
