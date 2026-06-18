import type {Industry} from "@stratosphere/core-layer/types";
import {useSanctumClient} from "#imports";

export const useIndustriesStore = defineStore('industries', () => {
    const client = useSanctumClient()
    const industries = ref<Industry[]>([])

    async function fetch() {
        industries.value = await client('/industries')
    }

    return {industries, fetch}
})