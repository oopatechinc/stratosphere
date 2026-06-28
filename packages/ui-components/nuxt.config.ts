// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  extends: ['@stratosphere/core-layer'],
  modules: ['vuetify-nuxt-module', '@nuxtjs/i18n'],
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
  // Explicitly tell Nuxt to inherit and pass through imports from extended layers
  imports: {
    dirs: [] // Keeps local engine active to bubble up parent configurations
  }
})
