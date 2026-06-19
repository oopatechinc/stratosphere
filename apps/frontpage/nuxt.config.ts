export default defineNuxtConfig({
    compatibilityDate: '2025-07-15',
    devtools: {enabled: true},
    runtimeConfig: {
        public: {
            apiBaseUrl: import.meta.env.API_BASE_URL,
            appSubdomain: import.meta.env.APP_SUBDOMAIN,
            nodeEnv: import.meta.env.NODE_ENV
        }
    },
    extends: [
        '@stratosphere/ui-components',
    ],
    sanctum: {
        baseUrl: 'https://api.oopatech99.com/api',
    }
})