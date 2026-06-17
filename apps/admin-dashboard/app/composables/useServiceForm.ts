import type {Service, User} from "#bookisia-shared-module/types"

export const useServiceForm = async () => {
    const BASE_URL = '/dashboard/services'

    const route = useRoute()
    const router = useRouter()
    const user = useSanctumUser<User>()
    const serviceStore = useServicesStore()
    const fileService = useFileService()
    const {decrypter} = useUtils()
    const {displayErrorMessage, displaySuccessMessage} = useSnackbarStore()
    const {t} = useI18n()
    const categoryStore = useCategoriesStore()
    await categoryStore.get()
    const {categories} = storeToRefs(categoryStore)
    //
    const formValidity = ref(null)
    const categoryId = route.params.id
    const isNewMode = categoryId === 'new'
    const image = ref()
    const uploadNewImage = ref(false)

    // categories
    const selectedCategories = ref<number[]>([])

    const initialData = ref<Service | undefined>({
        business_id: user.value!.staff?.business_id,
        name: '',
        description: '',
        variations: [
            {
                service_id: null,
                name: '',
                price: 0,
                duration: 30
            }
        ],
        categories: []
    })

    if (!isNewMode) {
        try {
            initialData.value = await serviceStore.getOne(Number(decrypter(String(categoryId))))
        } catch {
            await router.push(BASE_URL)
        }
    }

    const form = reactive<Service>({...initialData.value})

    const title = computed(() => isNewMode
        ? t('app.services.form.add_title') : t('app.services.form.edit_title'))
    const submitButtonText = computed(() =>
        isNewMode ? t('app.dictionary.save') : t('app.dictionary.update')
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
            await router.push(BASE_URL)
        } catch (error) {
            alert('An error occurred during submission.')
        }
    }

    async function submit() {
        form.variations![0]!.name = form.name!

        let error = false
        const service = await serviceStore.store(form).catch(() => {
            error = true
        }) as Service

        if (error) {
            return displayErrorMessage('An error occurred while saving service')
        }

        if (image.value) {
            const response = await fileService.send(
                image.value,
                'service',
                service.id!,
                fileService.ACTION_UPLOAD
            ).catch(() => {
                error = true
            }) as Service

            if (error) {
                displayErrorMessage('An error occurred while saving service image')
            }

            service.image_url = response.image_url
            await serviceStore.update(service)
        }

        displaySuccessMessage('Your service has been created')
    }

    async function update() {
        let error = false

        await serviceStore.update(form, true).catch(() => {
            error = true
        })

        if (error) {
            return displayErrorMessage('An error occurred while updating the service')
        }

        if (image.value) {
            await fileService.send(
                image.value,
                'service',
                form.id!,
                fileService.ACTION_REPLACE
            ).catch(() => {
                error = true
            })

            if (error) {
                displayErrorMessage('An error occurred while saving service image')
            }
        }

        // upload categories
        if (form.categories?.length) {
            await serviceStore.toggleCategories(form.id!, form.categories!)
        }

        await serviceStore.storeServiceVariations(form.id!, form.variations!)
        displaySuccessMessage('Your service has been updated')
    }

    return {
        categories,
        selectedCategories,
        formValidity,
        isNewMode,
        title,
        image,
        uploadNewImage,
        form,
        submitButtonText,
        handleSubmit
    }
}