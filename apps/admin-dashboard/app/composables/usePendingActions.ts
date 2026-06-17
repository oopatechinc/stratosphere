import {useLocationsStore} from "#imports";

export const usePendingActions = () => {
    const localePath = useLocalePath()
    const {locations} = storeToRefs(useLocationsStore())

    const actions = computed(() => {
        const items = []

        if (!locations.value.length) {
            items.push(
                {
                    props: {
                        title: "Add a location",
                        prependIcon: "mdi-cog",
                        href: localePath('/dashboard/business/locations/new'),
                        target: "_blank"
                    }
                }
            )
        }

        return items
    })

    return {actions}
}