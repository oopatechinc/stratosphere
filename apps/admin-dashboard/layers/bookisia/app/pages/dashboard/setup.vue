<script setup lang="ts">

import type {Tenant} from "@stratosphere/core-layer/types";
import {useTenantService} from "~/composables/useTenantService";
const {refreshIdentity, user} = useSanctumAuth()

definePageMeta({
  layout: 'blank'
})

const {fetch} = useIndustriesStore()
const {industries} = storeToRefs(useIndustriesStore())
await fetch()

const tenantStore = useTenantStore()

const industryId = ref(null)
const tenant = ref<Tenant>({
  name: '',
  vertical_id: undefined,
  remaining_trial_period_days: -1,
  services: [],
  subscription: {},
  vertical: {
    industry_id: 0,
    name: "",
    tag: "",
    industry: {
      id: 0,
      name: "",
      verticals: []
    }
  }
})
const loading = ref(false)

const verticals = computed(() => {
  if (!industryId.value) return []
  return industries.value.find(i => i.id === industryId.value)?.verticals
})

async function submit() {
  loading.value = true
  let error = false
  const response = await useTenantService().store(tenant.value).catch(() => {
    error = true
  })

  loading.value = false

  if (error) {
    throw Error('Storing business failed!!')
  }

  // set the business in store
  tenantStore.setTenant(response as Tenant)

  await refreshIdentity()

  navigateTo('/dashboard')
}

</script>

<template>
  <VCard class="mx-auto mt-10" max-width="600" flat color="transparent" :loading="loading">
    <VCardText>
      <h1 class="mb-8">Tell us about your business</h1>
      <p>No matter what you sell, Bookisia has the tools to take your business where you want it to go.</p>

      <h4 class="mt-8 mb-1">What is your business name?</h4>
      <VTextField
          v-model="tenant.name"
          class="mb-0"
          label="Business Name"
          messages="Your business name is how we'll identify you on emails, receipts and messages to customers."
          outlined
      />

      <h4 class="mt-4 mb-1">What type of business is it?</h4>
      <VSelect
          v-model="industryId"
          :items="industries"
          item-title="name"
          item-value="id"
          outlined
          label="Type of business"
      />

      <h4 class="mt-2">What category of business is it?</h4>
      <VSelect
          v-model="tenant.vertical_id"
          class="mb-4"
          :items="verticals"
          item-title="name"
          item-value="id"
          outlined
          label="Business category"
      />
      <VBtn color="primary" :loading="loading" block large @click="submit">Next</VBtn>
    </VCardText>
  </VCard>
</template>

<style scoped>

</style>