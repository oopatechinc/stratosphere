// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    'nuxt-auth-sanctum'
  ],
  sanctum: {
    mode: 'token',
    // endpoints: {
    //   login: '/auth/login',
    //   logout: '/auth/logout',
    //   user: '/user'
    // },
    // redirect: {
    //   onLogin: '/dashboard',
    //   onAuthOnly: '/dashboard'
    // }
  },
  imports: {
    dirs: ['stores']
  }
})