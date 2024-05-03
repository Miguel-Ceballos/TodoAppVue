<script setup>

import AllTasksForm from "@/Components/AllTasks/AllTasksForm.vue";
import Checkbox from "@/Components/Checkbox.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {useModalStore} from "@/stores/modal.js";
import {useAllTasksStore} from "@/stores/all-tasks.js";
import {computed} from "vue";

const modal = useModalStore()
const store = useAllTasksStore()

defineProps({
    tasks: {
        type: Object,
        required: true
    },
    categories: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <AppLayout title="Tasks">
        <template #header>
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Completed Tasks
            </h2>
        </template>

        <div class="py-6">

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

            <AllTasksForm :modal="modal.modal"
                          :form="store.form"
                          :categories="categories"
                          :update="modal.isUpdate"
                          :isCompleted="true"
                          @submit="store.action"
                          @handleClickModal="modal.handleClickModal(store.form)"
                          @deleteTask="store.deleteTask(modal.currentItem)"
            />

            <ul v-if="tasks.length > 0" role="list">
                <li v-for="task in tasks"
                    class="flex items-center gap-1 pl-2 md:gap-x-2 border-b hover:cursor-pointer hover:bg-gray-50"
                >
                    <!--                    <form @submit.prevent="store.markAsIncomplete(task)">-->
                    <!--                        <button type="submit">-->
                    <!--                            click here-->
                    <!--                            <Checkbox  :checked="task.status === 1 ?? false"/>-->
                    <!--                        </button>-->
                    <!--                    </form>-->
                    <!--                    <Checkbox @c="store.markAsIncomplete(task)" :checked="task.status === 1 ?? false"/>-->
                    <button type="button" @click="store.markAsIncomplete(task)"
                            class="border-gray-400 border rounded-full text-gray-600 hover:text-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                             class="w-5 h-5 p-0.5">
                            <path fill-rule="evenodd"
                                  d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div class="flex w-full gap-4 py-5 p-2 text-gray-600"
                         @click="modal.handleClickModalUpdate(task, store.form)">
                        <p class="text-sm text-gray-800">{{ task.status }} {{ task.title }}</p>
                    </div>
                </li>
            </ul>
            <p v-else class="mt-4">There are no tasks.</p>
        </div>
    </AppLayout>
</template>
