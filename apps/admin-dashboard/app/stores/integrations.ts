import type {Integration} from "@stratosphere/core-layer/types";
import {useSanctumClient, useSnackbarStore} from "#imports";

export const useIntegrationsStore = defineStore('integrations', () => {
    const integrations = ref<Integration[]>([])
    const client = useSanctumClient()
    const {displayErrorMessage} = useSnackbarStore()

    async function fetch() {
        if (integrations.value.length) return

        let error = false
        const response = await client('integrations').catch(() => {
            error = true
        })

        if (error) {
            return displayErrorMessage('An error occurred while fetching your integrations')
        }

        integrations.value = response as Integration[]
    }

    return {fetch, integrations}
})