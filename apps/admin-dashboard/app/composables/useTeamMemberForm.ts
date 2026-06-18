import type {
    User,
    Occupation,
    Address,
    LocationService,
    Staff,
    Location,
    TimeBlock,
} from "@stratosphere/core-layer/types"
import {useOpeningDays} from "~/composables/shared/useOpeningDays";
import {useStaffsStore} from "#imports"

export const useTeamMemberForm = async () => {
    const route = useRoute()
    const router = useRouter()
    const staffsStore = useStaffsStore()
    const fileService = useFileService()
    const {decrypter} = useUtils()
    const user = useSanctumUser<User>()

    const {displayErrorMessage, displaySuccessMessage} = useSnackbarStore()
    const {initialOpeningDays} = useOpeningDays()
    //
    const formValidity = ref(null)
    const paramId = route.params.id
    const isNewMode = paramId === 'new'
    const image = ref()
    const uploadNewImage = ref(false)
    const currentStep = ref(1)
    const submitBtnText = ref('Submit')

    const initialUserData = {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        type: 'staff'
    } as User

    const initialAddressData = <Address>{
        country_id: 41,
        state_id: undefined,
        address_line_1: '',
        address_line_2: '',
        city: '',
        postal_code: '',
    }

    const locations = <Location[]>[]

    const initialData = ref<Staff>({
        image_url: '',
        user: initialUserData,
        occupations: <Occupation[]>[{
            business_id: user.value?.staff?.business_id,
            title: '',
        }],
        location_services: <LocationService[]>[],
        opening_days: initialOpeningDays,
        locations,
        address: initialAddressData,
        opening_hour_exceptions: [],
        time_blocks: <TimeBlock[]>[]
    })

    const initialOccupations = <Occupation[]>[{
        business_id: user.value?.staff?.business_id,
        title: '',
    }]


    if (!isNewMode) {
        try {
            const staff = await staffsStore.get(Number(decrypter(String(paramId)))) as Staff

            if (!staff?.address) {
                staff.address = initialAddressData
            }

            if (!staff.occupations?.length) {
                staff.occupations = initialOccupations
            }

            initialData.value = staff as Staff
        } catch(e) {
            await router.push('/dashboard/team/team-members')
        }
    }

    const staff = ref<Staff>({...initialData.value})

    const title = "Profile"

    async function handleSubmit() {

        if (formValidity.value !== true) return

        try {
            if (isNewMode) {
                await submit()
            } else {
                await update()
            }

            // Redirect after success
            navigateTo('/dashboard/team/team-members')
        } catch(e) {
            alert('An error occurred during submission.')
        }
    }

    async function submit() {
        try {
             const s = await staffsStore.store(staff.value)

            if (image.value) {
                let error = false
                await fileService.send(
                    image.value,
                    'staff',
                    s!.id!,
                    fileService.ACTION_UPLOAD
                ).catch(() => {
                    error = true
                })

                if (error) {
                    return displayErrorMessage('Error while saving staff image')
                }
            }

            displaySuccessMessage('New staff has been created')
        } catch {
            displayErrorMessage('Unable to store staff')
        }
    }

    async function update() {
        await staffsStore.update(staff.value, true)

        if (image.value) {
            let error = false
            await fileService.send(
                image.value,
                'staff',
                staff.value.id!,
                fileService.ACTION_REPLACE
            ).catch(() => {
                error = true
            })

            if (error) {
                return displayErrorMessage('Error while saving staff image')
            }
        }

        displaySuccessMessage('Staff has been successfully updated')
    }

    return {
        formValidity,
        isNewMode,
        title,
        image,
        uploadNewImage,
        staff,
        submitBtnText,
        currentStep,
        handleSubmit
    }
}