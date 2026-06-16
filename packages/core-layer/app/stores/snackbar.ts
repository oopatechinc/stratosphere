import { defineStore } from 'pinia'
import {ref} from 'vue'
export const useSnackbarStore = defineStore('snackbar', () => {
    const message = ref('')
    const color = ref('')
    const display = ref(false)

    function displayMessage(msg: string) {
        message.value = msg
        display.value = true
    }

    function displaySuccessMessage(msg: string) {
        color.value = 'success'
        displayMessage(msg)
    }

    function displayErrorMessage(msg: string) {
        color.value = 'error'
        displayMessage(msg)
    }

    function getMessage() {
        return message
    }

    function closeMessage() {
        message.value = ''
        display.value = false
    }


    return {  displaySuccessMessage, displayErrorMessage, getMessage, closeMessage, display, color}
})
