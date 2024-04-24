import {defineStore} from "pinia";
import {ref} from "vue";

export const useModalStore = defineStore('modal', () => {

    const modal = ref(false)
    const isUpdate = ref(false)
    const currentItem = ref(Number)

    function handleClickModal(form) {
        isUpdate.value = false
        modal.value = !modal.value
        form.reset()
    }

    function handleClickModalUpdate(item, form) {
        currentItem.value = item.id
        isUpdate.value = true
        Object.assign(form, item)
        modal.value = !modal.value
    }

    return {
        modal,
        isUpdate,
        currentItem,
        handleClickModal,
        handleClickModalUpdate
    }
})
