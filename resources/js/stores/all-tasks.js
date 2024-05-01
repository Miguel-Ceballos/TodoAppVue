import {defineStore} from "pinia";
import {router, useForm} from "@inertiajs/vue3";
import {useModalStore} from "@/stores/modal.js";
import {computed} from "vue";

export const useAllTasksStore = defineStore('all-tasks', () => {

    const modal = useModalStore()

    const form = useForm({
        title: '',
        description: '',
        status: 0,
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
        form.delete(route('inbox.destroy', [id]), {preserveScroll: true})
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

    function markAsComplete(task){
        Object.assign(form, task)
        form.status = 1
        form.put(route('inbox.update', [task]), {preserveScroll: true})
        modal.modal = false
        form.reset()
    }

    function markAsIncomplete(task){
        Object.assign(form, task)
        form.status = 0
        form.put(route('completed-tasks.update', [task]), {preserveScroll: true})
        modal.modal = false
        form.reset()
    }

    return {
        form,
        action,
        deleteTask,
        markAsComplete,
        markAsIncomplete
    }
})
