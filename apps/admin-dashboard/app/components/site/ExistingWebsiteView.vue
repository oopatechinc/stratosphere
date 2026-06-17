<script setup lang="ts">
import {useTenantWebsiteStore} from "#imports"

const {websites} = useTenantWebsiteStore()

</script>

<template>
  <div class="container pa-2">
    <div class="d-flex justify-space-between">
      <h3>{{$t('app.dictionary.websites')}}</h3>

      <div class="pa-1 d-flex">
        <VBtn
            flat
            variant="tonal"
            rounded
            append-icon="mdi-open-in-new"
            class="mr-2"
            href="https://google.com"
            target="_blank"
        >{{$t('app.sites.index.external_btn')}}</VBtn>
        <VBtn rounded color="black" flat to="/dashboard/sites/create-website">{{ $t('app.sites.index.action_btn') }}</VBtn>
      </div>
    </div>

    <div class="ma-2">
      <VRow>
        <VCol v-for="(website, i) in websites" :key="i" md="4">
          <SiteWebsiteCard :website="website"/>
        </VCol>
      </VRow>
    </div>
  </div>
</template>