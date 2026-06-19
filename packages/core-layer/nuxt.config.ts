// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    'nuxt-auth-sanctum',
    'nuxt-echarts',
    '@nuxtjs/turnstile',
    'dayjs-nuxt',
    '@nuxtjs/i18n'
  ],
  sanctum: {
    mode: 'token'
  },
  imports: {
    dirs: ['stores']
  },
  dayjs: {
    plugins:[
      'utc',
      'timezone'
    ]
  },
  vite: {
    resolve: {
      alias: [
        { find: /^dayjs$/, replacement: 'dayjs/esm' },
        { find: /^dayjs\/plugin\/(.*)$/, replacement: 'dayjs/esm/plugin/$1' },
        { find: /^dayjs\/locale\/(.*)$/, replacement: 'dayjs/esm/locale/$1' },
      ],
    },
  },
})