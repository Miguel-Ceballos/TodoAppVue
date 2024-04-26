<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";
import TasksForm from "@/Components/Tasks/TasksForm.vue";
import {useModalStore} from "@/stores/modal.js";
import {useTasksStore} from "@/stores/tasks.js";
import {onMounted} from "vue";

const modal = useModalStore()
const store = useTasksStore()

onMounted(() => {
    store.currentCategory = props.category.slug
})

const props = defineProps({
    tasks: {
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

            <button @click="modal.handleClickModal(store.form)"
                    class="flex items-center gap-2 text-indigo-500 hover:text-indigo-600 mb-4"
                    type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-8 h-8">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                          clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-800 hover:text-indigo-600">Add Task</span>
            </button>

            <TasksForm :modal="modal.modal"
                          :form="store.form"
                          :statuses="statuses"
                          :update="modal.isUpdate"
                          @submit="store.action"
                          @handleClickModal="modal.handleClickModal(store.form)"
                          @deleteTask="store.deleteTask(modal.currentItem)"
            />

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
