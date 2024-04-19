<script setup>
import { initFlowbite } from 'flowbite'
import {onMounted} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import FormSection from "@/Components/FormSection.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

defineProps({
    form: {
        type: Object,
        required: true
    },
    updating: {
        type: Boolean,
        required: false,
        default: false
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

</script>

<template>
    <div>

        <button class="flex items-center gap-2 text-indigo-500 hover:text-indigo-600" data-modal-target="crud-modal" data-modal-show="crud-modal" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="w-8 h-8">
                <path fill-rule="evenodd"
                      d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                      clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-800 hover:text-indigo-600">Add Task</span>
        </button>

        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex pt-1 pr-1 rounded-t dark:border-gray-600">
                        <button type="button" data-modal-hide="crud-modal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <FormSection @submitted="$emit('submit')">
                        <template #form>
                            <div class="col-span-6 sm:col-span-6">
                                <InputLabel for="title" value="Name"/>
                                <TextInput id="title" v-model="form.title" type="text" autocomplete="title" class="mt-1 block w-full" placeholder="Note name"/>
                                <InputError v-if="form.errors" :message="form.errors.title" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <InputLabel for="description" value="Description"/>
                                <textarea id="description" name="description" v-model="form.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Note description..."></textarea>
                                <InputError v-if="form.errors" :message="form.errors.description" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <InputLabel for="status_id" value="Status"/>
                                <select id="status_id" name="status_id" v-model="form.status_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option v-for="status in statuses" :value="status.id">{{status.name}}</option>
                                </select>
                                <InputError v-if="form.errors" :message="form.errors.status_id" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <InputLabel for="category_id" value="Category"/>
                                <select id="category_id" name="category_id" v-model="form.category_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                                </select>
                                <InputError v-if="form.errors" :message="form.errors.category_id" class="mt-2"/>
                            </div>
                        </template>

                        <template #actions>
                            <PrimaryButton>
                                {{ updating ? 'Update' : 'Create' }}
                            </PrimaryButton>
                        </template>
                    </FormSection>
                </div>
            </div>
        </div>
    </div>
</template>
