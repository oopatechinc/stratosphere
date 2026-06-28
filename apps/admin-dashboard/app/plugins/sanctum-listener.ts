import { defineNuxtPlugin } from '#app'
import type {User} from "@stratosphere/core-layer/types";
export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.hook('sanctum:request', (app, ctx, logger) => {
    // ctx.options.headers.append('X-ORIGIN-API-KEY', nuxtApp.$config.public.originApiKey)

    ctx.options.query = ctx.options.query || {}
    ctx.options.query.XDEBUG_SESSION_START = 1


    const user = useSanctumUser<User>()
    const isGetUserUrl = ctx.request.toString().includes('/user')

    const isCentralDBRequest = ctx.request.toString().includes('/user')
        || ctx.request.toString().includes('stripe/create-checkout-session')

    if (!isCentralDBRequest && user.value?.tenant_id) {
      ctx.options.headers.append('X-Tenant-ID', String(user.value?.tenant_id))
    }
  })

  nuxtApp.hook('sanctum:response', (app, ctx, logger) => {
    // if (ctx.response.status === 401) navigateTo('/')
  })
})
