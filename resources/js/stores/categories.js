import {defineStore} from "pinia";
import {useModalStore} from "@/stores/modal.js";
import {router, useForm} from "@inertiajs/vue3";

export const useCategoriesStore = defineStore('categories', () => {

    const modal = useModalStore()

    const form = useForm({
        name: ''
    })

    function storeCategory() {
        form.post(route('categories.store'))
        router.on('success', (event) => {
            form.reset()
            modal.modal = false
        })
    }

    function updateCategory() {
        form.put(route('categories.update', [modal.currentItem]), {preserveScroll: true})
        form.reset()
        modal.modal = false
    }

    function deleteCategory(id) {
        form.delete(route('categories.destroy', [id]), {preserveScroll: true})
        form.reset()
        modal.modal = false
    }

    function action() {
        if (!modal.isUpdate) {
            storeCategory()
            return
        }
        updateCategory()
    }


    return {
        form,
        action,
        deleteCategory
    }
})
