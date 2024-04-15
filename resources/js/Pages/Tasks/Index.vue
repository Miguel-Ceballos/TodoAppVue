<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link} from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";

defineProps({
    tasks: {
        type: Object,
        required: true
    },
    category: {
        type: Object,
        required: true
    }
})

const deleteTask = id => {
    if (confirm('Are you sure?')) {
        Inertia.delete(route('tasks.destroy', id))
    }
}

</script>

<template>
    <AppLayout title="Tasks">
        <template #header>
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Tasks
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">

                    <Link :href="route('tasks.create', category.id)">
                        <PrimaryButton type="button" class="mb-10">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-4 h-4 mr-2">
                                <path fill-rule="evenodd"
                                      d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            CREATE TASK

                        </PrimaryButton>
                    </Link>

                    <ul v-if="tasks.length > 0" role="list" class="space-y-2">
                        <li v-for="task in tasks"
                            class="flex justify-between gap-x-6 py-5 p-2 border border-gray-100 rounded-md hover:bg-gray-100"
                        >
                            <div class="flex gap-4 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 ml-4">
                                    <path fill-rule="evenodd"
                                          d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <p class="text-md font-semibold leading-6 text-gray-800">{{ task.title }}</p>
                            </div>
                            <div class="flex gap-4 text-gray-600">
                                <p class="text-md font-semibold leading-6 text-gray-800">{{ task.status_id }}</p>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <div class="flex gap-4">
                                    <Link :href="route('tasks.edit', [task, category.id])"
                                          class="text-md leading-6 text-blue-600"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteTask(task.id)"
                                        class="text-md leading-6 text-red-600"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <p v-else>No hay notas existentes</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
