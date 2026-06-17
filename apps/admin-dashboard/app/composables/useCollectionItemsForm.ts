import type {CollectionItem} from "#bookisia-shared-module/types"

export const useCollectionItemsForm = async (type: string, returnUrl: string) => {
    const route = useRoute()
    const router = useRouter()
    const collectionsStore = useCollectionsStore()
    const fileService = useFileService()
    const {displayErrorMessage, displaySuccessMessage} = useSnackbarStore()
    const {t} = useI18n()

    const formValidity = ref(null)
    const id = route.params.id
    const isNewMode = id === 'new'
    const images = ref([])
    const uploadNewImage = ref(false)

    const title = computed(() => isNewMode
        ? t('app.properties.form.add_title') : t('app.properties.form.edit_title'))
    const submitButtonText = computed(() =>
        isNewMode ? t('app.dictionary.save') : t('app.dictionary.update')
    )

    async function handleSubmit(form) {
        if (formValidity.value !== true) return

        try {
            if (isNewMode) {
                await submit(form)
            } else {
                await update(form)
            }

            // Redirect after success
            await router.push(returnUrl)
        } catch {
            alert('An error occurred during submission.')
        }
    }

    async function submit(form) {
        let error = false
        const collection = await collectionsStore.store(form as CollectionItem).catch(() => {
            error = true
        }) as CollectionItem

        if (error) {
            return displayErrorMessage('An error occurred while saving service')
        }

        if (images.value.length) {
            for (const image of images.value) {
                const response = await fileService.send(
                    image,
                    'collectionItem',
                    collection.id!,
                    fileService.ACTION_UPLOAD
                ).catch(() => {
                    error = true
                })

                if (error) {
                    displayErrorMessage('An error occurred while saving service image')
                }

                await collectionsStore.update(response as CollectionItem)
            }




            await collectionsStore.update(collection)
        }

        displaySuccessMessage('Your property has been created')
    }

    async function update(form) {
        let error = false

        await collectionsStore.update(form as CollectionItem, true).catch(() => {
            error = true
        })

        if (error) {
            return displayErrorMessage('An error occurred while updating the property')
        }

        if (images.value.length) {
            for (const image of images.value) {
                const response = await fileService.send(
                    image,
                    'collectionItem',
                    form.id!,
                    fileService.ACTION_REPLACE
                ).catch(() => {
                    error = true
                })

                if (error) {
                    displayErrorMessage('An error occurred while saving service image')
                }

                await collectionsStore.update(response as CollectionItem)
            }




            await collectionsStore.update(form!)
        }

        displaySuccessMessage('Your service has been updated')
    }

    return {
        formValidity,
        isNewMode,
        title,
        images,
        uploadNewImage,
        submitButtonText,
        handleSubmit
    }
}