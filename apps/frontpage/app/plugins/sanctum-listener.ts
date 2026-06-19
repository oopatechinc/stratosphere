import { defineNuxtPlugin } from '#app'
export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.hook('sanctum:request', (app, ctx, logger) => {
    // ctx.options.headers.append('X-ORIGIN-API-KEY', nuxtApp.$config.public.originApiKey)

    // ctx.options.query = ctx.options.query || {}
    // ctx.options.query.XDEBUG_SESSION_START = 1

    const {domain} = useDomainStore()
    if (domain?.tenant_id) {
      ctx.options.headers.append('X-Tenant-ID', String(domain.tenant_id))
    }
  })

  nuxtApp.hook('sanctum:response', (app, ctx, logger) => {
    // if (ctx.response.status === 401) navigateTo('/')
  })
})
