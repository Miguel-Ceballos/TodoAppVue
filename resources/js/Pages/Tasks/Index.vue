<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, router} from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";
import Checkbox from "@/Components/Checkbox.vue";

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

const deleteTask = (category, task) => {
    if (confirm('Are you sure?')) {
        // Inertia.delete(route('tasks.destroy', [category, task]))
        router.delete(route('tasks.destroy', [category, task]))
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
            <Link :href="route('tasks.create', category.slug)">
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

            <ul v-if="tasks.length > 0" role="list">
                <li v-for="task in tasks"
                    class="flex justify-between items-center gap-x-6 py-5 p-2 border-b"
                >
                    <div class="flex gap-4 text-gray-600">
                        <Checkbox />
                        <p class="text-sm text-gray-800">{{ task.title }}</p>
                    </div>
                    <div class="flex gap-4 text-gray-600">
                        <p class="text-md text-gray-800">To do</p>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <div class="flex justify-center  gap-2">
                            <Link :href="route('tasks.edit', [task, category.slug])"
                                  class="text-md leading-6 text-gray-500 hover:bg-slate-100 p-1 rounded-md"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </Link>
                            <button
                                @click="deleteTask(category.slug, task.id)"
                                type="button"
                                class="text-md leading-6 text-gray-600 hover:bg-slate-100 p-1 rounded-md"
                            >
                                delete
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <p v-else>No hay notas existentes</p>
        </div>
    </AppLayout>
</template>
