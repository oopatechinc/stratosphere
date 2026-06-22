export default defineNuxtPlugin(async (nuxtApp) => {
    const tenant = useTenant()

    // 1. Get host name from request headers (SSR safe)
    const host = useRequestHeaders(['host']).host || ''

    // 2. Derive a tenant key (e.g., extract 'bookisia' or 'brokeryhub')
    // In production, this might call a fast cache database like Redis or an internal API endpoint.
    let tenantKey = 'default'
    if (host.includes('bookisia')) tenantKey = 'bookisia'
    if (host.includes('brokeryhub')) tenantKey = 'brokeryhub'

    // 3. Load or fetch tenant metadata profile
    const tenantConfigs: Record<string, any> = {
        bookisia: {
            id: 'bookisia',
            name: 'Bookisia Admin',
            logo: '/images/bookisia/bookisia-logo.svg',
            theme: { primary: '#6200EE', secondary: '#03DAC6', background: '#F5F5F5' },
            layout: 'split-screen'
        },
        brokeryhub: {
            id: 'brokeryhub',
            name: 'BrokeryHub Terminal',
            logo: '/images/brokery-hub/brokery-hub-logo.png',
            theme: { primary: '#ff9800', secondary: '#E91E63', background: '#121212' },
            layout: 'centered'
        }
    }

    tenant.value = tenantConfigs[tenantKey] || tenantConfigs['bookisia']
})