import type {Address, Location, User, Tenant, WebsiteTemplate} from "@stratosphere/core-layer/types"
import {useOpeningDays} from "~/composables/shared/useOpeningDays";
import {useServicesStore, useUtils} from "#imports";

export const useLocationForm = async () => {
    const {t} = useI18n()
    const route = useRoute()
    const router = useRouter()
    const user = useSanctumUser<User>()
    const store = useLocationsStore()
    const {tenant} = storeToRefs(useTenantStore())

    const {fetch: fetchServices} = useServicesStore()
    const {services} = storeToRefs(useServicesStore())

    const {fetch: fetchStaff} = useStaffsStore()
    const {staffs} = storeToRefs(useStaffsStore())

    await fetchServices(`?tenant_id=${user.value?.tenant_id}`)
    await fetchStaff(`?tenant_id=${user.value?.tenant_id}`)


    const {decrypter} = useUtils()
    const {displaySuccessMessage} = useSnackbarStore()
    const {initialOpeningDays} = useOpeningDays()
    //
    const formValidity = ref(null)
    const id = route.params.id
    const isNewMode = id === 'new'

    const initAddress = <Address>{
        country_id: 41,
        state_id: undefined,
        address_line_1: '',
        address_line_2: '',
        city: '',
        postal_code: '',
    }


    const initialData = ref<Location>({
        tenant_id: user.value!.staff!.tenant_id!,
        website_template_id: -1,
        language_id: 0,
        timezone_id: 0,
        nickname: '',
        type: 'Physical',
        subdomain: '',
        email: '',
        phone: '',
        x_account: '',
        instagram_account: '',
        facebook_account: '',
        linkedin_account: '',
        address: initAddress,
        opening_days: initialOpeningDays,
        opening_hour_exceptions: [],
        staff: [],
        services: [],
        tenant: <Tenant>{},
        website_template: <WebsiteTemplate>{},
        website_contents: [],
    })

    if (!isNewMode) {
        try {
            const location = await store.getOne(Number(decrypter(String(id))))

            if (location && !location?.address) {
                location.address = initAddress
            }

            if (location && !location.opening_days.length) {
                location.opening_days = initialOpeningDays
            }

            initialData.value = location as Location
        } catch {
            await router.push('/dashboard/business/locations')
        }
    }

    const location = reactive<Location>({...initialData.value})

    const locationTypes = [
        'Physical',
        'Online'
    ]

    const title = computed(() => isNewMode ? t('app.locations.form.add_title') : t('app.locations.form.edit_title'))
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
            router.push('/dashboard/business/locations')
        } catch {
            useSnackbarStore().displayErrorMessage('An error occurred during submission.')
        }
    }

    async function submit() {
        await store.store(location)

        displaySuccessMessage('Your location has been created')
        navigateTo('/dashboard/business/locations')
    }

    async function update() {
        await store.update(location, true)

        displaySuccessMessage('Your location has been updated')
        navigateTo('/dashboard/business/locations')
    }

    return {
        tenant,
        services,
        staffs,
        locationTypes,
        formValidity,
        isNewMode,
        title,
        location,
        submitButtonText,
        handleSubmit
    }
}