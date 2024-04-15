<script setup>

import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

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
    }
})

defineEmits(['submit'])

</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Name"/>
                <TextInput id="title" v-model="form.title" type="text" autocomplete="title" class="mt-1 block w-full" placeholder="Note title"/>
                <InputError :message="$page.props.errors.title" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="description" value="Description"/>
                <textarea id="description" name="description" v-model="form.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Note description..."></textarea>
                <InputError :message="$page.props.errors.description" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="status_id" value="Status"/>
                <select id="status_id" name="status_id" v-model="form.status_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    <option v-for="status in statuses" :value="status.id">{{status.name}}</option>
                </select>
                <InputError :message="$page.props.errors.status_id" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <PrimaryButton>
                {{ updating ? 'Update' : 'Create' }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
