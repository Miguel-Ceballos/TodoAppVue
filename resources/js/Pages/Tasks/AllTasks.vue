<script setup>

import Checkbox from "@/Components/Checkbox.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import FormSection from "@/Components/FormSection.vue";


defineProps({
    tasks: {
        type: Object,
        required: true
    },
    statuses: {
        type: Object,
        required: true
    },
    categories: {
        type: Object,
        required: true
    }
})

const isUpdating = ref(false)

const form = useForm({
    title: '',
    description: '',
    status_id: {
        type: Number
    },
    category_id: {
        type: Number
    }
})

const modal = ref(false)

const storeTask = () => {
    form.post(route('inbox.store'))
    router.on('success', (event) => {
        modal.value = false
        form.reset()
    })
}

const handleClickModal = () => {
    modal.value = !modal.value
}

const handlerClickUpdate = () => {
    isUpdating.value = !isUpdating.value
    handleClickModal()
}

const deleteTask = (task) => {
    if (confirm('Are you sure?')) {
        // Inertia.delete(route('tasks.destroy', [category, task]))
        router.delete(route('inbox.destroy', [task]))
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

            <button @click="handleClickModal" class="flex items-center gap-2 text-indigo-500 hover:text-indigo-600"
                    type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-8 h-8">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                          clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-800 hover:text-indigo-600">Add Task</span>
            </button>

            <Modal :show="modal" @handleClickModal="handleClickModal">
                <div class="flex pt-1 pr-1 rounded-t dark:border-gray-600">
                    <button @click="handleClickModal" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <FormSection @submitted="storeTask">
                    <template #form>
                        <div class="col-span-6 sm:col-span-6">
                            <InputLabel for="title" value="Name"/>
                            <TextInput id="title" v-model="form.title" type="text" autocomplete="title"
                                       class="mt-1 block w-full" placeholder="Note name"/>
                            <InputError v-if="form.errors" :message="form.errors.title" class="mt-2"/>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <InputLabel for="description" value="Description"/>
                            <textarea id="description" name="description" v-model="form.description" rows="4"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      placeholder="Note description..."></textarea>
                            <InputError v-if="form.errors" :message="form.errors.description" class="mt-2"/>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <InputLabel for="status_id" value="Status"/>
                            <select id="status_id" name="status_id" v-model="form.status_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                            <InputError v-if="form.errors" :message="form.errors.status_id" class="mt-2"/>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <InputLabel for="category_id" value="Category"/>
                            <select id="category_id" name="category_id" v-model="form.category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                            <InputError v-if="form.errors" :message="form.errors.category_id" class="mt-2"/>
                        </div>
                    </template>

                    <template #actions>
                        <PrimaryButton>
                            {{ isUpdating ? 'Update' : 'Create' }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </Modal>

            <ul v-if="tasks.length > 0" role="list">
                <li v-for="task in tasks"
                    class="flex justify-between items-center gap-2 md:gap-x-6 py-5 p-2 border-b"
                >
                    <div class="flex gap-4 text-gray-600">
                        <Checkbox/>
                        <p class="text-sm text-gray-800">{{ task.title }}</p>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <div class="flex justify-center gap-2">
                            <!--                            <Link :href="route('inbox.index')"-->
                            <!--                                  class="text-md leading-6 text-gray-500 hover:bg-slate-100 p-1 rounded-md"-->
                            <!--                            >-->
                            <!--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"-->
                            <!--                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">-->
                            <!--                                    <path stroke-linecap="round" stroke-linejoin="round"-->
                            <!--                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>-->
                            <!--                                </svg>-->
                            <!--                            </Link>-->
                            <button
                                @click="handlerClickUpdate"
                                class="text-md leading-6 text-gray-600 hover:bg-slate-100 p-1 rounded-md"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                </svg>
                            </button>
                            <button
                                @click="deleteTask(task.id)"
                                class="text-md leading-6 text-gray-600 hover:bg-slate-100 p-1 rounded-md"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <p v-else>No hay notas existentes</p>
        </div>
    </AppLayout>
</template>
