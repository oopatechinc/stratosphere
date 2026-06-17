import {useSanctumClient} from "#imports";

export const useIndustryService = () => {
    const client = useSanctumClient()
    async function get() {
        return client('/industries')
    }

    async function store(payload: []) {
        return client('/industries', {method: 'POST', body: payload})
    }

    return {get, store}
}