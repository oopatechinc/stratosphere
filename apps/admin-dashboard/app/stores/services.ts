import type {Category, Service, ServiceVariation} from "#bookisia-shared-module/types"

export const useServicesStore = defineStore('services', () => {
    const client = useSanctumClient();

    const services = ref<Service[]>([])
    const loading = ref(false)
    const isInitialized = ref(false)

    async function fetch(params = '') {
        if (isInitialized.value) return

        let error = false
        loading.value = true
        const fetchedServices = await client(`services${params}`).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to retrieve services')
        }

        isInitialized.value = true
        services.value = fetchedServices as Service[]
    }

    async function getOne(id: number) {
        if (!isInitialized.value) await fetch()
        return services.value.find(c => c.id === id)
    }

    async function store(payload: Service) {
        let error = false
        loading.value = true
        const newService = await client<Service>(
            '/services',
            {method: 'POST', body: payload}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save category')
        }

        services.value.unshift(newService!)
        return newService as Service
    }

    async function update(service: Service, updateApi = false) {
        if (updateApi) {
             await client<Service>(`services/${service.id}`, {method: 'PUT', body: service})
        }

        const index = services.value.findIndex(s => s.id === service.id)
        if (index == -1) return
        services.value[index] = service
    }

    async function storeServiceVariations(serviceId: number, payload: ServiceVariation[]) {
        let error = false
        loading.value = true
        const serviceVariations = await client<Service>(
            '/service-variations',
            {method: 'POST', body: {variations: payload}}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save category')
        }

        const serviceIndex = services.value.findIndex(s => s.id === serviceId)
        services.value[serviceIndex]!.variations = serviceVariations as ServiceVariation[]
    }

    async function toggleCategories(serviceId: number, payload: Category[]) {
        let error = false
        loading.value = true
        const service = await client<Service>(
            `/services/${serviceId}/toggle-categories`,
            {method: 'POST', body: {categories: payload}}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save category')
        }

        const serviceIndex = services.value.findIndex(s => s.id === serviceId)
        services.value[serviceIndex]! = service as Service
    }

    return {loading, services, fetch, getOne, store, update, storeServiceVariations, toggleCategories}
})

