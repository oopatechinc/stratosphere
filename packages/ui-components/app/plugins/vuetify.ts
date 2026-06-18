import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { defineNuxtPlugin } from '#app'
import 'vuetify/styles' // MANDATORY: Import the necessary Vuetify styles
// import '@mdi/font/css/materialdesignicons.css' // Import MDI CSS
import { VFileUpload } from 'vuetify/labs/VFileUpload'



// You can customize theme, icons, etc., here.
const vuetifyOptions = {
  components: {
    ...components,
    VFileUpload
  },
  directives,
  theme: {
    defaultTheme: 'light',
  },
  icons: {
    defaultSet: 'mdi',
  },
}

export default defineNuxtPlugin((nuxtApp) => {
  const vuetify = createVuetify(vuetifyOptions)

  // Use the Vuetify instance in the Nuxt application
  nuxtApp.vueApp.use(vuetify)
})
