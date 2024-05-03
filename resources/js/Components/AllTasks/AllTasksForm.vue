<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import FormSection from "@/Components/FormSection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    form: {
        type: Object,
        required: true
    },
    modal: {
        type: Boolean,
        required: true
    },
    update: {
        type: Boolean,
        required: true,
        default: false
    },
    isCompleted: {
        type: Boolean,
        required: true,
        default: false
    }
})

defineEmits(['submit', 'handleClickModal', 'deleteTask'])

</script>

<template>
    <Modal :show="modal" @handleClickModal="$emit('handleClickModal')">
        <div class="flex pt-1 pr-1 rounded-t dark:border-gray-600">
            <button @click="$emit('handleClickModal')" type="button"
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
        <FormSection @submitted="$emit('submit')">
            <template #form>
                <div class="col-span-6 sm:col-span-6">
                    <InputLabel for="title" value="Name"/>
                    <TextInput id="title" v-model="form.title" type="text" autocomplete="title"
                               class="mt-1 block w-full" placeholder="Note name" :readonly="isCompleted"/>
                    <InputError v-if="form.errors" :message="form.errors.title" class="mt-2"/>
                </div>

                <div class="col-span-6 sm:col-span-6">
                    <InputLabel for="description" value="Description"/>
                    <textarea id="description" name="description" v-model="form.description" rows="4"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="Note description..." :readonly="isCompleted"></textarea>
                    <InputError v-if="form.errors" :message="form.errors.description" class="mt-2"/>
                </div>

                <div class="col-span-6 sm:col-span-6">
                    <InputLabel for="category_id" value="Category"/>
                    <select id="category_id" name="category_id" v-model="form.category_id" :disabled="isCompleted"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option v-for="category in categories" :readonly="isCompleted" :value="category.id">{{ category.name }}</option>
                    </select>
                    <InputError v-if="form.errors" :message="form.errors.category_id" class="mt-2"/>
                </div>
            </template>

            <template #actions>
                <PrimaryButton v-if="!isCompleted">
                    {{ update ? 'Update' : 'Create' }}
                </PrimaryButton>
            </template>
            <button
                v-if="update && !isCompleted"
                @click="$emit('deleteTask')"
                class="text-md leading-6 text-gray-600 p-1 rounded-md flex gap-2 hover:bg-red-50 hover:text-red-600"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
                Delete
            </button>
        </FormSection>
    </Modal>
</template>
