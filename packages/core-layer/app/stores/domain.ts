import {ref} from "#imports"

export const useDomainStore = defineStore('domain', () => {
    const domain = ref()
    const pageContent = ref<"loading" | "underConstruction" | "website">('loading')

    async function fetch(subdomain: string) {
        const {data, status} = await useSanctumFetch(`domains/${subdomain}`, {method:'GET'})

        if (status.value === 'success') {
            domain.value = data.value
            pageContent.value = 'website'
        } else {
            pageContent.value = 'underConstruction'
        }
    }

    function getSubdomain() {
        const {host} = useRequestURL()

        if (!host) return null

        const parts = host.split('.')
        if (parts.length > 2) {
            return parts[0]
        }
        return null
    }

    return {domain, pageContent, fetch, getSubdomain}
})