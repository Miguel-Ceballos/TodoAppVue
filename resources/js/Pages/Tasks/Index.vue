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
            <h2 class="font-bold text-3xl text-gray-700 leading-tight">
                Tasks {{ category.name }}
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
                          :update="modal.isUpdate"
                          @submit="store.action"
                          @handleClickModal="modal.handleClickModal(store.form)"
                          @deleteTask="store.deleteTask(modal.currentItem)"
            />

            <ul v-if="tasks.length > 0" role="list">
                <li v-for="task in tasks"
                    class="flex items-center gap-1 md:gap-x-2 border-b hover:cursor-pointer hover:bg-gray-50"
                >
                    <Checkbox/>
                    <div class="flex w-full gap-4 py-5 p-2 text-gray-600" @click="modal.handleClickModalUpdate(task, store.form)">
                        <p class="text-sm text-gray-800">{{ task.title }}</p>
                    </div>
                </li>
            </ul>
            <p v-else>No hay notas existentes</p>
        </div>
    </AppLayout>
</template>
