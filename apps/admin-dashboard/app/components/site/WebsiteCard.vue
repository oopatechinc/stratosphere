<script setup lang="ts">
import type {Website} from "#bookisia-shared-module/types"
defineProps<{website: Website}>()

const localePath = useLocalePath()

</script>

<template>
  <VCard
      class="mx-auto"
      max-width="400"
  >
    <VCardTitle class="d-flex elevation-1 mb-2">
<!--      {{template.name}}-->
<!--        <VSpacer />-->
<!--        <VChip v-if="Number(business.theme_id) === Number(theme.id)" color="success">-->
<!--          Current Theme-->
<!--        </VChip>-->
<!--        <VBtn v-else  color="primary" variant="outlined" size="small" rounded @click="makeActive(template)">Make Active</VBtn>-->
    </VCardTitle>
    <VCardText>
      <VImg
          class="align-end text-white"
          height="400"
          :src="website.template.image_url"
          contain
      />
    </VCardText>

    <VCardActions>
      <VBtn
          :text="$t('app.sites.templates.preview_text')"
          prepend-icon="mdi-eye"
          :to="localePath(`/dashboard/sites/preview/${website.id}`)"
      />
      <VSpacer />
      <VBtn
          :text="$t('app.sites.templates.edit_text')"
          prepend-icon="mdi-pencil"
          :to="localePath(`/dashboard/sites/editor/${website.id}`)"
      />
    </VCardActions>
  </VCard>
</template>

<style scoped>

</style>