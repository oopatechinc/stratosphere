// apps/admin-dashboard/layers/bookisia/nuxt.config.ts
import { defineNuxtConfig } from 'nuxt/config'

export default defineNuxtConfig({
    future: {
        compatibilityVersion: 4,
    },
    runtimeConfig: {
        public: {
            bookisia: {
                appName: 'Bookisia Admin',
                supportEmail: 'support@bookisia.com',
                // Layer-specific API endpoints or feature toggles go here
                enableAdvancedCalendar: true,
            }
        }
    },
    modules: ['@nuxtjs/i18n'],
    css: [
        // './app/assets/css/bookisia-overrides.css' // if you have unique css tweaks
    ],
    i18n: {
        langDir: 'locales',
        strategy: 'prefix_except_default',
        locales: [
            {
                code: 'en-US',
                iso: 'en-US',
                name: 'English(US)',
                file: 'en-US.json',
            },
            {
                code: 'fr-CA',
                iso: 'fr-CA',
                name: 'French(CA)',
                file: 'fr-CA.json',
            },
        ],
        defaultLocale: 'en-US',
    },
})