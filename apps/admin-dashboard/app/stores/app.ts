import type {User} from "@stratosphere/core-layer/types";

export const useAppStore = defineStore('app', () => {
    const navigationUrl = ref('/')
    const user = useSanctumUser<User>()

    function isVertical(verticalTag: string) {
        return user.value?.tenant.vertical.tag === verticalTag
    }

    return {navigationUrl, isVertical}
})