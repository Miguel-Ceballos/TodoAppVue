import {defineStore} from "pinia";
import {ref} from "vue";
import {router, useForm} from "@inertiajs/vue3";


export const useModalStore = defineStore('modal', () => {

    const modal = ref(false)
    const isUpdate = ref(false)
    const currentTask = ref(Number)

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
            modal.value = false
            form.reset()
        })
    }

    function updateTask() {
        form.put(route('inbox.update', [currentTask.value]))
        router.on('success', (event) => {
            modal.value = false
            form.reset()
        })
    }

    function deleteTask(id) {
        if (confirm('Are you sure?')) {
            router.delete(route('inbox.destroy', [id]), {preserveScroll: true})
        }
    }

    function handleClickModal() {
        isUpdate.value = false
        modal.value = !modal.value
        form.reset()
    }

    function handleClickModalUpdate(task) {
        currentTask.value = task.id
        isUpdate.value = true
        Object.assign(form, task)
        modal.value = !modal.value
    }

    function action() {
        if (!isUpdate.value) {
            storeTask()
            return
        }
        updateTask()
    }

    return {
        form,
        modal,
        isUpdate,
        action,
        deleteTask,
        handleClickModal,
        handleClickModalUpdate
    }
})
