// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  extends: ['@stratosphere/core-layer'],
  modules: ['vuetify-nuxt-module'],
  vuetify: {
    moduleOptions: {
      /* nuxt-vuetify module specific options */
    },
    vuetifyOptions: {
      /* native vuetify options */
      theme: {
        defaultTheme: 'light',
        // themes: { ... }
      }
    }
  },
  // Explicitly tell Nuxt to inherit and pass through imports from extended layers
  imports: {
    dirs: [] // Keeps local engine active to bubble up parent configurations
  }
})