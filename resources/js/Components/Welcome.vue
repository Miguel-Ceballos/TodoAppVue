<script setup>
import {onMounted} from "vue";
import {initFlowbite} from "flowbite";
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div class="">
        <h1>hello world</h1>
    </div>
</template>
