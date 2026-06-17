<script setup lang="ts">
import {useIntegrations} from "~/composables/useIntegrations";

definePageMeta({
  middleware: 'verify-business'
})

const {fetch} = useIntegrationsStore()
const {integrations} = storeToRefs(useIntegrationsStore())

await fetch()

const tab = ref('')
const {integrations: integrationSchema} = useIntegrations()

const connectedIntegrations = computed(() => {
  const connectedIntegrations = integrations.value.map(i => i.platform)
  return integrationSchema.value.filter(ic => connectedIntegrations.includes(ic.platform))
})
</script>

<template>
  <div class="container pa-2">
    <div class="d-flex justify-space-between">
      <h3>{{$t('app.dictionary.integrations')}}</h3>
    </div>

    <VCard flat class="mt-4">
      <VTabs v-model="tab" color="primary">
        <VTab value="discover">{{$t('app.dictionary.discover')}} ({{integrationSchema.length}})</VTab>
        <VTab value="manage">{{$t('app.dictionary.manage')}} ({{integrations.length}}) <VIcon class="ml-1" color="grey">mdi-check-circle</VIcon></VTab>
      </VTabs>

      <VDivider />

      <VTabsWindow v-model="tab">
        <VTabsWindowItem value="discover">
          <VRow class="ma-3">
            <VCol v-for="(integration, i) in integrationSchema" :key="i" cols="12" sm="6" md="3">
              <IntegrationsCard
                  :card="integration.card"
                  :platform="integration.platform"
                  :icon="integration.icon"
              />
            </VCol>
          </VRow>
        </VTabsWindowItem>
        <VTabsWindowItem value="manage">
          <VRow class="ma-3">
            <VCol v-for="(integration, i) in connectedIntegrations" :key="i" cols="12" sm="6" md="3">
              <IntegrationsCard
                  :card="integration.card"
                  :platform="integration.platform"
                  :icon="integration.icon"
              />
            </VCol>
          </VRow>
        </VTabsWindowItem>
      </VTabsWindow>
    </VCard>

  </div>

</template>

<style scoped>

</style>