// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  extends: ['@stratosphere/core-layer'],
  modules: ['vuetify-nuxt-module'],
  vuetify: {
    moduleOptions: {
    },
    vuetifyOptions: {
      directives: true,
      theme: {
        defaultTheme: 'light',
      }
    }
  },
  build: {
    transpile: [
      'v-phone-input',
      'vuetify'
    ],
  },
  // Explicitly tell Nuxt to inherit and pass through imports from extended layers
  imports: {
    dirs: [] // Keeps local engine active to bubble up parent configurations
  }
})
