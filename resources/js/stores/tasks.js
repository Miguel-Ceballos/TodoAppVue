import {defineStore} from "pinia";
import {router, useForm} from "@inertiajs/vue3";
import {useModalStore} from "@/stores/modal.js";

export const useTasksStore = defineStore('tasks', () => {

    const modal = useModalStore()

    const form = useForm({
        title: '',
        description: '',
        status_id: {
            type: Number
        }
    })

    function storeTask() {
        form.post(route('tasks.store'))
        router.on('success', (event) => {
            modal.modal = false
            form.reset()
        })
    }

    function updateTask() {
        form.put(route('tasks.update', [modal.currentItem]), {preserveScroll: true})
        modal.modal = false
        form.reset()
    }

    function deleteTask(id) {
        form.delete(route('tasks.destroy', [id]), {preserveScroll: true})
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
        action,
        deleteTask
    }
})
