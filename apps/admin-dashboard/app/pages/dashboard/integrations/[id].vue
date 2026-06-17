<script setup lang="ts">
import {useIntegrations} from "#imports";

const localePath = useLocalePath()
const {fetch} = useIntegrationsStore()
const {integrations} = storeToRefs(useIntegrationsStore())
const {integrations: items} = useIntegrations()
await fetch()


const platform = useRoute().params.id

const isExistingIntegration = integrations.value.filter(i => i.platform === platform).length
const existingComponent = items.value.find(i => i.platform === platform)!.pages.connected.editComponent

const activeComponent = isExistingIntegration
    ? resolveComponent(existingComponent)
    : resolveComponent('IntegrationsNewIntegration')


</script>

<template>
  <VDialog :model-value="true" scrollable fullscreen >
    <VCard flat>
      <VCardTitle class="d-flex justify-space-between">
        <VBtn icon flat :to="localePath('/dashboard/integrations')">
          <VIcon>mdi-close</VIcon>
        </VBtn>
      </VCardTitle>

      <VCardText>
        <component v-if="activeComponent" :is="activeComponent" />
      </VCardText>
    </VCard>
  </VDialog>
</template>

<style scoped>

</style>