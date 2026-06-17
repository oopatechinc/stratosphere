import type {User} from "#bookisia-shared-module/types";

export default defineNuxtRouteMiddleware(() => {
    const {isAuthenticated} = useSanctumAuth()
    const localePath = useLocalePath()
    const user = useSanctumUser<User>()
    if (!isAuthenticated.value) {
        return navigateTo(localePath('/login'))
    }

    if (user.value?.tenant_id === null) {
        return navigateTo(localePath('/dashboard/setup'))
    }
});