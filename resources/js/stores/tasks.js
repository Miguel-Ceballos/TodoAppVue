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
            form.reset()
            modal.modal = false
        })
    }

    function updateTask() {
        form.put(route('tasks.update', [currentCategory.value, modal.currentItem]), {preserveScroll: true})
        form.reset()
        modal.modal = false
    }

    function deleteTask(id) {
        form.delete(route('tasks.destroy', [currentCategory.value, id]), {preserveScroll: true})
        form.reset()
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
