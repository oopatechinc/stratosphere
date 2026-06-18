import type {Occupation} from "@stratosphere/core-layer/types"

export const useOccupationsStore = defineStore('occupations', () => {
    const client = useSanctumClient();
    const {displaySuccessMessage, displayErrorMessage} = useSnackbarStore()


    const occupations = ref<Occupation[]>([])
    const loading = ref(false)
    const isInitialized = ref(false)

    async function get(params = '') {
        if (isInitialized.value) return

        let error = false
        loading.value = true
        occupations.value = await client<Occupation[]>(`/occupations${params}`).catch(() => {
            error = true
        }) as Occupation[]
        loading.value = false

        if (error) {
            throw Error('Unable to retrieve services')
        }

        isInitialized.value = true
    }

    async function getOne(id: number) {
        if (!isInitialized.value) await get()
        return occupations.value.find(o => o.id === id)
    }

    async function store(payload: Occupation) {
        const jobAlreadyExists = occupations.value.findIndex(
            o => o.title.toLowerCase() === payload.title.toLowerCase()
        ) !== -1

        if (jobAlreadyExists) {
            return displayErrorMessage('Job already exists')
        }

        let error = false
        loading.value = true
        const savedOccupation = await client<Occupation>(
            '/occupations',
            {method: 'POST', body: payload}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save occupation')
        }

        occupations.value.unshift(savedOccupation!)
        displaySuccessMessage('New job created')
    }

    async function update(occupation: Occupation, updateApi = false) {
        if (updateApi) {
             await client<Occupation>(`/occupations/${occupation.id}`, {method: 'PUT', body: occupation})
        }

        const index = occupations.value.findIndex(o => o.id === occupation.id)
        if (index == -1) return
        occupations.value[index] = occupation
    }

    return {loading, occupations, get, getOne, store, update}
})

