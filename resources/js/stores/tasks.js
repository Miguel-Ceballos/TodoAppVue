import {defineStore} from "pinia";
import {router, useForm} from "@inertiajs/vue3";
import {useModalStore} from "@/stores/modal.js";
import {ref} from "vue";

export const useTasksStore = defineStore('tasks', () => {

    const modal = useModalStore()
    const currentCategory = ref('')

    const form = useForm({
        title: '',
        description: '',
        status: 0
    })

    function storeTask() {
        form.post(route('tasks.store', [currentCategory.value]))
        router.on('success', (event) => {
            modal.modal = false
            form.reset()
        })
    }

    function updateTask() {
        form.put(route('tasks.update', [currentCategory.value, modal.currentItem]), {preserveScroll: true})
        modal.modal = false
        form.reset()
    }

    function deleteTask(id) {
        form.delete(route('tasks.destroy', [currentCategory.value, id]), {preserveScroll: true})
        modal.modal = false
    }

    function action() {
        if (!modal.isUpdate) {
            storeTask()
            return
        }
        updateTask()
    }

    return {
        form,
        currentCategory,
        action,
        deleteTask
    }
})
