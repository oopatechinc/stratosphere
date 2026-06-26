
export interface NavigationItem {
    titleKey: string
    prependIcon: string
    to: string
    feature?: string
}

export interface CHILD_ITEM {
    props: NavigationItem,
    children?: {props: NavigationItem}[]
}
export interface ITEM {
    props: NavigationItem,
    childItems?: CHILD_ITEM[]
}

export type MenuRegistry = Record<string, ITEM[]>

export const useMenuRegistry = () => {
    return useState<MenuRegistry>('menu_registry', () => ({
        // You can populate default items here if needed
        global: [
            {
                props: {
                    titleKey: 'app.navigation_drawer.home',
                    prependIcon: "mdi-home-city",
                    feature: "home",
                    to: "/dashboard"
                },
                childItems: []
            },
        ]
    }))
}