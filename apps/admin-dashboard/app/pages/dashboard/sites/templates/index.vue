<script setup lang="ts">
import {useLocationsStore, useWebsiteTemplatesService} from "#imports";

const templates = await useWebsiteTemplatesService().fetch()

const {locations} = storeToRefs(useLocationsStore())
const currentLocation = ref(locations.value[0])

</script>

<template>
  <VDialog :model-value="true" scrollable fullscreen>
    <VCard flat>
      <VCardTitle class="d-flex justify-space-between">
        <VBtn icon flat to="/dashboard/sites">
          <VIcon>mdi-close</VIcon>
        </VBtn>
      </VCardTitle>
      <VCardText>
        <div v-if="locations.length" class="pa-1">
          <VSelect
              v-model="currentLocation"
              :items="locations"
              class="mr-2"
              variant="outlined"
              flat
              :label="$t('app.sites.index.select_label')"
              density="compact"
              min-width="200px"
              rounded
              item-title="nickname"
              width="40"
          />
        </div>
        <h3 class="pl-6 my-6">{{$t('app.sites.templates.title')}}</h3>
        <VRow>
          <VCol v-for="(template, i) in templates" :key="i" cols="3" >
            <SiteTemplateCard
                :template="template"
                return-url="/dashboard/sites/templates"
            />
          </VCol>
        </VRow>
      </VCardText>
    </VCard>
  </VDialog>
</template>