<script setup>

import FormCategories from "@/Components/Categories/FormCategories.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="Categories">
        <template #header>
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Create a new category
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <FormCategories :form="form" @submit="form.post(route('categories.store'))" :updating="true"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
