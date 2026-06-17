<script setup lang="ts">

import {useIntegrations} from "#imports";

const client = useSanctumClient()
const {integrations} = storeToRefs(useIntegrationsStore())
const {integrations: items, GOOGLE_PLATFORM_INTEGRATIONS} = useIntegrations()
const {displaySuccessMessage, displayErrorMessage} = useSnackbarStore()
const {t} = useI18n()
const localePath = useLocalePath()

const platform = useRoute().params.id

const item = items.value.find(ci => ci.platform === platform)

const integration = integrations.value.find(i => i.platform === 'google-calendar')!
const primaryResource = integration.resources.find(ir => ir.is_primary)

interface GoogleCalendar {
  id: string
}

const calendars = await client<GoogleCalendar[]>(`google/get-calendar-by-integration-id/${integration!.id}`)

async function update() {
  await client(`integrations/${integration.id}`, {method: 'PUT', body: integration})
  displaySuccessMessage(t(`app.integrations.${platform}.notifications.update_success`))
}

async function handleRevoke() {
  let error = false
  await client(`integrations/${integration.id}`, {method: 'DELETE'}).catch(()=> {
    error = true
  })

  if (error) {
    return displayErrorMessage(t(`app.integrations.${platform}.notifications.calendar_revoke_failed`))
  }

  //remove the Google platform integrations following revoke
  GOOGLE_PLATFORM_INTEGRATIONS.forEach(platform => {
    const index = integrations.value.findIndex(i => i.platform === platform)
    integrations.value.splice(index, 1)
  })

  displaySuccessMessage(t(`app.integrations.${platform}.notifications.revoke_success`))
  useRouter().push(localePath('/dashboard/integrations'))
}

</script>

<template>
  <div class="container">
    <VCard class="pa-4 mx-auto" max-width="1200">
      <VCardTitle class="text-wrap">
        <h4>{{$t(`app.integrations.${platform}.connected.title`)}}</h4>
      </VCardTitle>
      <VCardText class="mt-6">
        <div class="d-flex justify-space-between">
          <div class="d-flex align-center">
            <div class="mr-4">
              <VImg :src="`/icons/${item?.icon}`" width="100" />
            </div>
            <div>
              {{$t('app.integrations.connected_by')}} <br> <b>{{primaryResource?.resource_id}}</b>
            </div>
          </div>
          <div>
            <VBtn
                variant="outlined"
                color="primary"
                rounded
                :text="$t('app.integrations.revoke_btn')"
                @click="handleRevoke"
            />
          </div>
        </div>

        <VDivider class="my-4 mt-6" />

        <div>
          <h3 class="my-6">{{$t(`app.integrations.${platform}.connected.calendar_select_title`)}}</h3>
          <VSelect
              v-model="integration.primary_resource_id"
              :items="calendars"
              variant="outlined"
              density="compact"
              prepend-icon="mdi-calendar-outline"
              item-title="id"
          >
            <template #append>
              <VBtn color="primary" :text="$t('app.dictionary.update')" @click="update"/>
            </template>
          </VSelect>
        </div>
      </VCardText>
    </VCard>

  </div>
</template>

<style scoped>

</style>