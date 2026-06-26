export default defineNuxtPlugin({
    name: 'brokery-hub-menu-registry',
    enforce: 'pre',
    setup() {

        const menuRegistry = useMenuRegistry()
        menuRegistry.value.brokeryhub = [
            {
                props: {
                    titleKey: 'app.navigation_drawer.online',
                    feature: "online",
                    prependIcon: "mdi-web",
                    to: "/dashboard/sites"
                },
                childItems: []
            },
            {
                props: {
                    titleKey: 'app.navigation_drawer.settings',
                    feature: "settings",
                    prependIcon: "mdi-cog"
                },
                childItems: [
                    {
                        props: {
                            titleKey: "app.navigation_drawer.personal_information",
                            prependIcon: 'mdi-account',
                            to: '/dashboard/account/personal-information'
                        }
                    },
                    {
                        props: {
                            titleKey: "app.navigation_drawer.my_business",
                            prependIcon: 'mdi-store',
                        },
                        children: [
                            {
                                props: {
                                    titleKey: "app.navigation_drawer.about",
                                    prependIcon: 'mdi-information',
                                    to: '/dashboard/business/about'
                                }
                            },
                            {
                                props: {
                                    titleKey: "app.navigation_drawer.locations",
                                    prependIcon: 'mdi-map-marker',
                                    to: '/dashboard/business/locations'
                                }
                            }
                        ]
                    },
                    {
                        props: {
                            titleKey: "app.dictionary.subscription",
                            prependIcon: 'mdi-credit-card',
                            to: '/dashboard/account/subscription'
                        }
                    },
                ]
            }
        ] as ITEM[]
    }
})