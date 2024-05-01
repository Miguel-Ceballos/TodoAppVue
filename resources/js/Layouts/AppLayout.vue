<script setup>
import {ref} from 'vue';
import {Head, router} from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import NavLink from "@/Components/NavLink.vue";
import { initFlowbite } from 'flowbite'
import {onMounted} from "vue";
import {useModalStore} from "@/stores/modal.js";
import {useAllTasksStore} from "@/stores/all-tasks.js";
import AllTasksForm from "@/Components/AllTasks/AllTasksForm.vue";

// const modalStore = useModalStore()
// const store = useAllTasksStore()

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

defineProps({
    title: String
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title"/>

        <Banner/>
    </div>

    <!-- SIDEBAR -->

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
            aria-controls="sidebar-multi-level-sidebar" type="button"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
           class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
           aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-50 dark:bg-gray-800">
            <h1 class="text-2xl text-center my-4 text-slate-700">My <span class="font-bold">TODO</span> list</h1>
            <ul class="space-y-1 font-medium">
<!--                <li>-->
<!--                    <button @click="modalStore.handleClickModal(store.form)"-->
<!--                            class="flex items-center pl-0 text-sm font-light text-indigo-600 rounded-sm hover:bg-slate-100 group transition duration-150 ease-in-out w-full gap-2"-->
<!--                            type="button">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"-->
<!--                             class="w-8 h-8">-->
<!--                            <path fill-rule="evenodd"-->
<!--                                  d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"-->
<!--                                  clip-rule="evenodd"/>-->
<!--                        </svg>-->
<!--                        <span class="font-bold">Add Task</span>-->
<!--                    </button>-->

<!--                    <AllTasksForm :modal="modalStore.modal"-->
<!--                                  :form="store.form"-->
<!--                                  :categories="$page.props.user.categories"-->
<!--                                  :update="modalStore.isUpdate"-->
<!--                                  @submit="store.action"-->
<!--                                  @handleClickModal="modal.handleClickModal(store.form)"-->
<!--                                  @deleteTask="store.deleteTask(modalStore.currentItem)"-->
<!--                    />-->
<!--                </li>-->
                <li>
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </NavLink>
                </li>
                <li>
                    <NavLink :href="route('inbox.index')" :active="route().current('inbox.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <span class="ms-3">Tasks</span>
                    </NavLink>
                </li>
<!--                <li>-->
<!--                    <NavLink :href="route('inbox.index')" :active="route().current('inbox.index')">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">-->
<!--                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />-->
<!--                        </svg>-->
<!--                        <span class="ms-3">Today</span>-->
<!--                    </NavLink>-->
<!--                </li>-->
                <li>
                    <NavLink :href="route('completed-tasks.index')" :active="route().current('completed-tasks.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="ms-3">Completed</span>
                    </NavLink>
                </li>
            </ul>
            <ul class="mt-2">
                <li>
                    <NavLink :href="route('categories.index')" :active="route().current('categories.*')" class="flex items-center ms-0">
                        <span class="whitespace-nowrap text- w-6 h-6 p-1 font-bold">Categories</span>
                    </NavLink>
                </li>
                <li v-if="$page.props.user.categories.length > 0" v-for="category in $page.props.user.categories">
                    <NavLink :href="route('tasks.index', category.slug)"
                             :active="route().current('tasks.*', category.slug)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                        </svg>
                        <span class="ms-3">{{ category.name }}</span>
                    </NavLink>
                </li>
                <p v-else class="text-gray-500 text-sm pt-2">There are no categories.</p>
                <!--                <li>-->
                <!--                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">-->
                <!--                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">-->
                <!--                            <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>-->
                <!--                        </svg>-->
                <!--                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">E-commerce</span>-->
                <!--                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">-->
                <!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>-->
                <!--                        </svg>-->
                <!--                    </button>-->
                <!--                    <ul id="dropdown-example" class="hidden py-2 space-y-2">-->
                <!--                        <li>-->
                <!--                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </li>-->
            </ul>
        </div>
    </aside>

    <div class="sm:ml-64">
        <div class="rounded-lg dark:border-gray-700">
            <div class="min-h-screen rounded bg-white dark:bg-gray-800 p-4 gap-2">
                <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-10 mx-auto">
                    <header v-if="$slots.header">
                        <slot name="header"/>
                    </header>

                    <!-- Page Content -->
                    <main>
                        <slot/>
                    </main>
                </div>
            </div>
        </div>
    </div>

</template>
