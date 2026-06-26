// middleware/tenant-guard.global.ts
export default defineNuxtRouteMiddleware((to) => {
    const tenant = useTenant()

    // If a user on bookisia tries to access a brokerhub-specific path
    if (to.path.startsWith('/dashboard/agent') && tenant.value.id !== 'brokeryhub') {
        return navigateTo('/dashboard')
    }

    if (to.path.startsWith('/dashboard/staff') && tenant.value.id !== 'bookisia') {
        return navigateTo('/dashboard')
    }
})