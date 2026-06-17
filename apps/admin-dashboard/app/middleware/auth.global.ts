export default defineNuxtRouteMiddleware((to) => {
    const localePath = useLocalePath()

    const exemptPaths = [
        '/verifyzoom',
        localePath('/'),
        localePath('/signup'),
        localePath('/forgot-password'),
        localePath('/redirect'),
    ]

    if (!exemptPaths.includes(to.path)) {
        const auth = useSanctumAuth()
        if (!auth.isAuthenticated.value) {
            return useRouter().push('/')
        }
    }
});