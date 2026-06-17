import type {Category, Location}  from ""

export const useLocationsStore = defineStore('locations', () => {
    const client = useSanctumClient();

    const locations = ref<Location[]>([])
    const loading = ref(false)

    async function fetch(params = '') {
        if (locations.value.length) return

        let error = false
        loading.value = true
        const response = await client(`locations${params}`).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to retrieve locations')
        }

        locations.value = response as Location[]
    }

    async function getOne(id: number) {
        if (!locations.value.length) await fetch()
        return locations.value.find(l => l.id === id)
    }

    async function store(payload: Location) {
        let error = false
        loading.value = true
        const response = await client<Location>(
            '/locations',
            {method: 'POST', body: payload}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save location')
        }

        locations.value.unshift(response!)
        return response as Location
    }

    async function update(location: Location, updateApi = false) {
        if (updateApi) {
            await client<Category>(`/locations/${location.id}`, {method: 'PUT', body: location})
        }

        const index = locations.value.findIndex(l => l.id === location.id)
        if (index == -1) return
        locations.value[index] = location
    }

    return {locations, loading, fetch, getOne, store, update}
})