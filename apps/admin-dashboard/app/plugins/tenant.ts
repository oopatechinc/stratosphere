import type {User} from "~/types";

export default defineNuxtPlugin(async () => {
    const user = useSanctumUser<User>()
    const {fetchTenantById} = useTenantStore()
    if (user.value?.tenant_id) {
        await fetchTenantById(user.value?.tenant_id, '&appendSubscription=true&appendPlugins=true&appendVertical=true')
    }
})