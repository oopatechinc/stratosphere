import {useSnackbarStore} from "#imports"

export const useImageUpload = () => {
    const {displayErrorMessage} = useSnackbarStore()

    const filesToUpload = ref<File[]>([])
    const tempImages = ref<string[]>([])

    function previewImage (event: Event) {
        // Reference to the DOM input element
        const input = event.target as HTMLInputElement;

        //validate sizes
        for (const file of input.files!) {
            if (file.type.includes('image/') && file.size > 2097152) {
                displayErrorMessage('One or more files is too large. Maximum image size is 2MB')
                break
            }

            if (file.type.includes('video/') && file.size > 10485760) {
                displayErrorMessage('One or more files is too large. Maximum video size is 10MB')
                break
            }
        }

        // Ensure that you have a file before attempting to read it
        for (let i = 0; i < input.files!.length; i++) {
            filesToUpload.value.push(input.files![i] as File)
            readImageFile(input.files![i] as File)
        }
    }
    function readImageFile(file: File) {
        // create a new FileReader to read this image and convert to base64 format
        const reader = new FileReader();
        // Define a callback function to run, when FileReader finishes its job
        reader.onload = (e) => {
            // Read file as base64 and set to imageData
            const base64Image = e.target!.result as string
            tempImages.value.push(base64Image)
        }
        // Start the reader job - read file as a data url (base64 format)
        reader.readAsDataURL(file);
    }

    return {tempImages, filesToUpload, previewImage, readImageFile}
}