<script setup lang="ts">
import {useLocationsStore, useWebsiteTemplatesService} from "#imports";
import type {User} from "#bookisia-shared-module/types";

const route = useRoute()
const returnUrl = route.query.returnUrl as string
const isDemo = route.query.isDemo === "true"
const templateId = Number(route.params.id)

const user = useSanctumUser<User>()

const {tenant} = storeToRefs(useTenantStore())
const {fetch: fetchLocations} = useLocationsStore()
const {locations} = storeToRefs(useLocationsStore())

const {isVertical} = useAppStore()

let domain = ''
if (isVertical('real_estate')) {
  domain = user.value?.staff?.domain.url
}

// await fetchLocations()

// const templates = await useWebsiteTemplatesService().fetch()
// const template = templates.find(t => t.id === templateId)
// const location = locations.value.find(l => l.id === locationId)

</script>

<template>
  <WebsiteViewer
      v-if="isDemo"
      :is-demo="true"
      :is-dialog="true"
      :redirect-url="returnUrl"
      :template-name="template.name"
  />
  <WebsiteViewer
      v-else
      :is-demo="false"
      source="admin"
      :is-dialog="true"
      :domain="domain"
      :template-id="templateId"
      :redirect-url="returnUrl"
  />
</template>

<style scoped>

</style>