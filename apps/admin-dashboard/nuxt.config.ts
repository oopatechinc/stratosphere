export default defineNuxtConfig({
    compatibilityDate: '2025-07-15',
    devtools: {enabled: true},
    extends: [
        '@stratosphere/ui-components',
    ],
    runtimeConfig: {
        public: {
            stripePubKey: import.meta.env.STRIPE_PUBLISHABLE_KEY,
            apiBaseUrl: import.meta.env.API_BASE_URL,
            indexedDBName: import.meta.env.INDEXED_DB_NAME,
            googleMapsApiKey: import.meta.env.GOOGLE_MAPS_API_KEY,
            sessionStoreName: import.meta.env.SESSION_STORE_NAME,
            sessionTokenKey: import.meta.env.SESSION_TOKEN_KEY,
            nodeEnv: import.meta.env.NODE_ENV,
            zoomClientId: import.meta.env.ZOOM_CLIENT_ID,
            redirectUrl: import.meta.env.REDIRECT_URL,
            locationWebsiteSuffix: import.meta.env.LOCATION_WEBSITE_SUFFIX
        },
        turnstile: {
            secretKey: import.meta.env.TURNSTILE_SECRET_KEY
        }
    },
    build: {
        transpile: [
            'vuetify',
            'v-phone-input'
        ],
    },
    sanctum: {
        baseUrl: import.meta.env.API_BASE_URL,
        mode: 'token',
        endpoints: {
            login: '/auth/login',
            logout: '/auth/logout',
            user: '/user'
        },
        redirect: {
            onLogin: '/dashboard',
            onAuthOnly: '/dashboard'
        }
    },
    i18n: {
        langDir: "locales",
        strategy: "prefix_except_default",
        locales: [
            {
                code: "en-US",
                iso: "en-US",
                name: "English(US)",
                file: "en-US.json"
            },
            {
                code: "fr-CA",
                iso: "fr-CA",
                name: "French(CA)",
                file: "fr-CA.json"
            }
        ],
        detectBrowserLanguage: {
            useCookie: true,
            cookieKey: 'i18n_redirected',
            alwaysRedirect: true,
            fallbackLocale: 'en'
        },
        defaultLocale: "en-US"
    },
    dayjs: {
        plugins:[
            'utc',
            'timezone'
        ]
    },
    echarts: {
        charts: ['BarChart', 'LineChart'],
        components: ['TitleComponent', 'DatasetComponent', 'GridComponent', 'TooltipComponent'],
        renderer: 'canvas',
        features: ['LabelLayout', 'UniversalTransition']
    },
    turnstile: {
        siteKey: import.meta.env.TURNSTILE_SITE_KEY
    },
})