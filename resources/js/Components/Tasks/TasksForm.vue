<script setup>

import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Modal from "@/Components/Modal.vue";

defineProps({
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
    statuses: {
        type: Object,
        required: true
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
                               class="mt-1 block w-full" placeholder="Note title"/>
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
            </template>

            <template #actions>
                <PrimaryButton>
                    {{ update ? 'Update' : 'Create' }}
                </PrimaryButton>
            </template>
        </FormSection>
    </Modal>
</template>
