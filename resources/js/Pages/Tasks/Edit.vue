<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import StatusesForm from "@/Components/Statuses/StatusesForm.vue";
import TasksForm from "@/Components/Tasks/TasksForm.vue";

const props = defineProps({
    task: {
        type: Object,
        required: true
    },
    category: {
        type: Object,
        required: true
    },
    statuses: {
        type: Object,
        required: true
    }
})

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    status_id: props.task.status_id
})

</script>

<template>
    <AppLayout title="Statuses">
        <template #header>
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Update Task
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <TasksForm
                        :form="form"
                        @submit="form.put(route('tasks.update', [task, category.slug]))"
                        :updating="true"
                        :statuses="statuses"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
