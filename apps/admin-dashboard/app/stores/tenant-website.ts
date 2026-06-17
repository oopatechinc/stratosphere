import type {Website} from "#bookisia-shared-module/types";

export const useTenantWebsiteStore = defineStore('tenant_websites', () => {
    const client = useSanctumClient();

    const websites = ref<Website[]>([])
    const loading = ref(false)

    async function fetch(params = '') {
        if (websites.value.length) return

        let error = false
        loading.value = true
        const response = await client(`websites${params}`).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to retrieve websites')
        }

        websites.value = response as Website[]
    }

    async function getOne(id: number) {
        if (!websites.value.length) await fetch()
        return websites.value.find(l => l.id === id)
    }

    return {websites, loading, fetch, getOne}
})