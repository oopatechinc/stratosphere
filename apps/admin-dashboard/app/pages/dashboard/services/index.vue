<script setup lang="ts">
const localePath = useLocalePath()
const store = useServicesStore()
await store.fetch()

const {services} = storeToRefs(store)

</script>

<template>
  <div class="container pa-2">
    <div v-if="services.length !== 0" class="d-flex justify-space-between">
      <h3>{{$t('app.dictionary.services')}}</h3>
      <VBtn rounded color="black" flat :to="localePath('/dashboard/services/new')">{{$t('app.services.action_btn')}}</VBtn>
    </div>

    <VCard v-if="services.length === 0">
      <VCardText class="d-flex justify-center">
        <div class="text-center">
          <VIcon size="60">mdi-folder-outline</VIcon>
          <h3 class="mt-3 mb-2">Services</h3>
          <p class="mb-2">{{$t('app.services.explanation')}}</p>
          <VBtn color="primary" :to="localePath('/dashboard/services/new')">{{$t('app.services.action_btn')}}</VBtn>
        </div>
      </VCardText>
    </VCard>
    <VCard v-else class="mt-10">
      <ServicesDataTable :services="services" />
    </VCard>
  </div>
</template>

<style scoped>

</style>