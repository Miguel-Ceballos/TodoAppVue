<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm} from "@inertiajs/vue3";
import TasksForm from "@/Components/Tasks/TasksForm.vue";

defineProps({
    statuses: {
        type: Object,
        required: true
    },
    category: {
        type: Object,
        required: true
    }
})

const form = useForm({
    title: '',
    description: '',
    status_id: {
        type: Number
    }
})

</script>

<template>
    <AppLayout title="Tasks">
        <template #header>
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Create a New Task
            </h2>
        </template>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <TasksForm :form="form" @submit="form.post(route('tasks.store', category.id))" :statuses="statuses"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
