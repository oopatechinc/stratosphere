export default defineNuxtPlugin({
    name: 'bookisia-menu-registry',
    enforce: 'pre',
    setup() {

        const menuRegistry = useMenuRegistry()
        menuRegistry.value.bookisia = [
            {
                props: {
                    titleKey: "app.navigation_drawer.calendar",
                    prependIcon: "mdi-calendar",
                    feature: "calendar",
                    to: "/dashboard/calendar"
                },
                childItems: []
            },
            {
                props: {
                    titleKey: 'app.navigation_drawer.catalog',
                    prependIcon: "mdi-tag",
                    feature: "catalog",
                },
                childItems: [
                    {
                        props: {
                            titleKey: "app.navigation_drawer.services",
                            prependIcon: 'mdi-cog',
                            to: '/dashboard/services'
                        }
                    },
                    {
                        props: {
                            title: "app.navigation_drawer.categories",
                            prependIcon: 'mdi-store',
                            to: '/dashboard/categories'
                        }
                    },
                ]
            },
            {
                props: {
                    titleKey: 'app.navigation_drawer.staff',
                    feature: "staff",
                    prependIcon: "mdi-account-group-outline"
                },
                childItems: [
                    {
                        props: {
                            titleKey: "app.navigation_drawer.team_members",
                            prependIcon: 'mdi-cog',
                            to: '/dashboard/team/team-members'
                        }
                    }
                ]
            },
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
                    titleKey: 'app.navigation_drawer.integrations',
                    feature: "integrations",
                    prependIcon: "mdi-transit-connection-variant",
                    to: "/dashboard/integrations"
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