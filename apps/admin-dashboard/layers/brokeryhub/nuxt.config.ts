// apps/admin-dashboard/layers/bookisia/nuxt.config.ts
import { defineNuxtConfig } from 'nuxt/config'

export default defineNuxtConfig({
    // 1. Explicitly opt into Nuxt 4 folder structures for this layer
    future: {
        compatibilityVersion: 4,
    },

    // 2. Add metadata or configuration options specific to this vertical
    // This runtimeConfig merges automatically into the main app's runtimeConfig
    runtimeConfig: {
        public: {
            bookisia: {
                appName: 'Brokery Hub Admin',
                supportEmail: 'support@brokeryhub.com',
                // Layer-specific API endpoints or feature toggles go here
                enableAdvancedCalendar: true,
            }
        }
    },

    // 3. Layer-isolated auto-imports or layout overrides (optional)
    // If Bookisia needs access to specific third-party components or styling assets
    // that other layers shouldn't care about, you can declare them here.
    css: [
        // './app/assets/css/bookisia-overrides.css' // if you have unique css tweaks
    ],
})