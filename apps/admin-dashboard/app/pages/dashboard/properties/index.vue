<script setup lang="ts">
const localePath = useLocalePath()
const store = useCollectionsStore()

const {collectionItems} = storeToRefs(store)


await store.fetch('properties')


</script>

<template>
  <div class="container pa-2">
    <div v-if="collectionItems.length !== 0" class="d-flex justify-space-between">
      <h3>{{$t('app.properties.title')}}</h3>
      <VBtn rounded color="black" flat :to="localePath('/dashboard/properties/new')">{{$t('app.properties.action_btn')}}</VBtn>
    </div>

    <VCard v-if="collectionItems.length === 0">
      <VCardText class="d-flex justify-center">
        <div class="text-center">
          <VIcon size="60">mdi-folder-outline</VIcon>
          <h3 class="mt-3 mb-2">{{$t('app.properties.title')}}</h3>
          <p class="mb-2">{{$t('app.properties.explanation')}}</p>
          <VBtn color="primary" :to="localePath('/dashboard/properties/new')">{{$t('app.properties.action_btn')}}</VBtn>
        </div>
      </VCardText>
    </VCard>
    <VCard v-else class="mt-10 pb-2 mx-4" flat>
      <VRow>
        <VCol v-for="(property, i) in collectionItems" :key="i" cols="12" md="6" lg="4">
          <PropertyCard v-model="collectionItems[i]" />
        </VCol>
      </VRow>
    </VCard>
  </div>
</template>

<style scoped>

</style>