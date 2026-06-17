<script setup lang="ts">
import {useSanctumClient} from "#imports";
import type {User} from "#bookisia-shared-module/types";

const client = useSanctumClient()
const user = useSanctumUser<User>()
const route = useRoute()
const platform = route.params.id

const state = {
  platform,
  action: 'platform_integration',
  integrable_id: user.value?.staff?.id,
  integrable_type: user.value?.staff?.morph_class,
}

async function handleConnect() {
  window.location.href = await client('integrations/get-oauth-url', {method: 'POST', body: state})
}
</script>

<template>
  <VCard max-width="700" class="mx-auto">
    <VCardTitle class="mb-6 elevation-1">
      <div><h4>{{ $t(`app.integrations.${platform}.pages.disconnected.title`) }}</h4></div>
    </VCardTitle>
    <VCardText>
      <VRow>
        <VCol cols="12" md="8">
          <div><h4>{{ $t(`app.integrations.${platform}.pages.disconnected.subtitle`) }}</h4></div>
          <div class="ma-4">
            <ul>
              <li
                  v-for="(feature, i) in $tm(`app.integrations.${platform}.pages.disconnected.features`)"
                  :key="i"
              >{{ $rt(feature) }}
              </li>
            </ul>
          </div>
          <div><h4>{{ $t('app.dictionary.requirements') }}</h4></div>
          <div class="ma-4">
            <ul>
              <li
                  v-for="(requirement, i) in $tm(`app.integrations.${platform}.pages.disconnected.requirements`)"
                  :key="i"
              > {{ $rt(requirement) }}
              </li>
            </ul>
          </div>

          <div class="mt-6">
            <VBtn
                color="primary"
                rounded
                :text="$t(`app.integrations.${platform}.pages.disconnected.action_btn`)"
                @click="handleConnect()"
            />
          </div>
        </VCol>
        <VCol cols="12" md="4">
          <VImg :src="`/icons/${platform}.svg`" max-width="80%"/>
        </VCol>
      </VRow>
    </VCardText>
  </VCard>
</template>

<style scoped>

</style>