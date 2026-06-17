<script setup lang="ts">
const localePath = useLocalePath()
const {actions} = usePendingActions()

const emit = defineEmits(['hideDialog'])



</script>

<template>
  <VCard>
    <VCardTitle class="d-flex justify-space-between elevation-1 bg-info">
      <h3>Pending Actions</h3>
      <VBtn icon="mdi-close" flat color="info" @click="emit('hideDialog')"/>
    </VCardTitle>
    <VCardText>
      <p class="mb-4 text-justify">
        It is recommended to finish setting up your business before moving on to website creation. This is so that you can preview your website as it will be seen by your customers. Below is a list of the pending actions.
      </p>

      <VDivider class="my-4" />

      <div class="d-flex mb-4">
        <VIcon color="info" size="30" class="mr-2 mt-1">mdi-information</VIcon>
        <small>Clicking on these actions will open a page in a new tab. Once you create the required items, you can refresh this page and click on create website again</small>
      </div>

      <VCard elevation="1">
        <VCardText>
          <VList :items="actions">
            <template #append="{item}">
              <VBtn variant="outlined" append-icon="mdi-open-in-new" :to="item.props.link">Fix</VBtn>
            </template>
          </VList>
        </VCardText>
      </VCard>
    </VCardText>
    <VCardActions>
      <VSpacer />
      <VBtn :to="localePath('/dashboard/sites/templates')">Continue anyway</VBtn>
    </VCardActions>
  </VCard>
</template>

<style scoped>

</style>