import type { Tenant } from "~/types"
import { ref } from 'vue'
import { defineStore } from 'pinia'
import {useSanctumClient, useSanctumFetch} from '#imports'

export const useTenantStore = defineStore('tenant', () => {
  const params = '?appendServices=true&appendCategories=true&appendStaff=true&appendLocations=true&appendPlugin=true'

  const client = useSanctumClient()

  const tenant = ref<Tenant>()
  const loading = ref(false)

  async function fetchTenantByUrl(url: string) {
    if (tenant.value || !url) return
    loading.value = true
    let error = false
    const response = await client<Tenant>(`url${params}`).catch(() => {
      error = true
    })

    loading.value = false

    if (error) {
      throw new Error('Unable to retrieve business')
    }

    tenant.value = response as Tenant
  }

  async function fetchTenantById(id: number, extraParams = '') {
    if (!id || tenant.value) return
    const mergedParams = params + extraParams.trim().replace(/^([?&]?)/, '&')
    loading.value = true
    const { data, status } = await useSanctumFetch<Tenant>(`/tenants/${id}${mergedParams}`)

    loading.value = false

    if (status.value === 'error') {
      throw new Error('Unable to retrieve business 55')
    }

    tenant.value = data.value as Tenant
  }

  function setTenant(data: Tenant) {
    tenant.value = data
  }

  async function update(tenantId: number, payload: Tenant, params = '') {
    let error = false
    const response = await client<Tenant>(`tenants/${tenantId}${params}`, { method: 'PUT', body: payload }).catch(() => {
      error = true
    }) as Tenant

    if (error) {
      throw new Error('Unable to update tenant')
    }

    tenant.value = response as Tenant
  }

  return { loading, tenant, fetchTenantByUrl, fetchTenantById, update, setTenant }
})
