import type {Category, User} from "@stratosphere/core-layer/types"

export const useCategoryForm = async () => {
    const route = useRoute()
    const router = useRouter()
    const user = useSanctumUser<User>()
    const store = useCategoriesStore()
    const fileService = useFileService()
    const {decrypter} = useUtils()

    const {displayErrorMessage, displaySuccessMessage} = useSnackbarStore()
    //
    const formValidity = ref(null)
    const categoryId = route.params.id
    const isNewMode = categoryId === 'new'
    const image = ref()
    const uploadNewImage = ref(false)

    const initialData = ref<Category>({
        business_id: user.value!.staff!.business_id,
        name: '',
    })

    if (!isNewMode) {
        try {
            initialData.value = await store.getOne(Number(decrypter(String(categoryId)))) as Category
        } catch {
            await router.push('/dashboard/categories')
        }
    }

    const form = reactive<Category>({...initialData.value})

    const title = computed(() => isNewMode ? "Add New Category" : "Edit Category")
    const submitButtonText = computed(() =>
        isNewMode ? 'Save' : 'Update'
    )

    async function handleSubmit() {
        if (formValidity.value !== true) return

        try {
            if (isNewMode) {
                await submit()
            } else {
                await update()
            }

            // Redirect after success
            router.push('/dashboard/categories')
        } catch (error) {
            alert('An error occurred during submission.')
        }
    }

    async function submit() {
        let error = false
        const category = await store.store(form).catch(() => {
            error = true
        }) as Category

        if (error) {
            return displayErrorMessage('An error occurred while saving the category')
        }

        if (image.value) {
            const uploadResponse = await fileService.send(
                image.value,
                'category',
                category.id!,
                fileService.ACTION_UPLOAD
            ).catch(() => {
                error = true
            }) as Category

            if (error) {
                return displayErrorMessage('An error occurred while uploading the category image')
            }

            category.image_url = uploadResponse.image_url
            await store.update(category)
        }

        displaySuccessMessage('Your category has been created')
        navigateTo('/dashboard/categories')
    }

    async function update() {
        let error = false
        await store.update(form, true).catch(() => {
            error = true
        })

        if (error) {
            return displayErrorMessage('An error occurred while updating the category')
        }

        if (image.value) {
            const uploadResponse = await fileService.send(
                image.value,
                'category',
                form.id!,
                fileService.ACTION_REPLACE
            ).catch(() => {
                error = true
            }) as Category

            if (error) {
                return displayErrorMessage('An error occurred while uploading the category image')
            }

            form.image_url = uploadResponse.image_url
            await store.update(form)
        }

        displaySuccessMessage('Your category has been updated')
        navigateTo('/dashboard/categories')
    }

    return {
        formValidity,
        isNewMode,
        title,
        image,
        uploadNewImage,
        form,
        submitButtonText,
        handleSubmit,
    }
}