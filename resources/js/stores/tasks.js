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
        },
        category_id: {
            type: Number
        }
    })

    function storeTask() {
        form.post(route('inbox.store'))
        router.on('success', (event) => {
            modal.modal = false
            form.reset()
        })
    }

    function updateTask() {
        form.put(route('inbox.update', [modal.currentItem]), {preserveScroll: true})
        modal.modal = false
        form.reset()
    }

    function deleteTask(id) {
        router.delete(route('inbox.destroy', [id]), {preserveScroll: true})
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
