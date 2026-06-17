export const useAppStore = defineStore('app', () => {
    const navigationUrl = ref('/')
    const {tenant} = useTenantStore()

    function isVertical(verticalTag: string) {
        return tenant?.vertical.tag === verticalTag
    }

    return {navigationUrl, isVertical}
})