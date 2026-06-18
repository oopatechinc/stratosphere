<script setup lang="ts">
import type {ServiceVariation} from "@stratosphere/core-layer/types";

const emit = defineEmits(['hideDialog'])

const initialData = {
  service_id: -1,
  name: '',
  price: 0,
  duration: 30
}
const variations = defineModel<ServiceVariation[]>()

function addVariation() {
  variations.value?.push({...initialData})
}

function removeVariation(index: number) {
  variations.value?.splice(index, 1)
}

</script>

<template>
<VCard>
  <VCardTitle class="bg-black d-flex justify-space-between">
    <div class="d-flex">
      <VBtn color="black" icon="mdi-close" @click="emit('hideDialog')" />
      <p class="mt-2 ml-2">Service Variations</p>
    </div>
    <VBtn
        class="mt-2"
        prepend-icon="mdi-plus"
        variant="outlined"
        text="Add Variation"
        rounded
        @click="addVariation"
    />
  </VCardTitle>
  <VCardText>
    <VCard v-for="(variation, i) in variations" :key="i" class="mb-4" elevation="3">
      <VCardTitle class="d-flex justify-space-between elevation-1">
        <span>Variation {{i+1}}</span>
        <VBtn icon flat @click="removeVariation(i)">
          <VIcon>mdi-minus</VIcon>
        </VBtn>
      </VCardTitle>
      <VCardText>
        <ServiceVariationForm v-model="variations![i]" :is-dialog="true" class="mt-4"/>
      </VCardText>
    </VCard>
  </VCardText>
  <VCardActions>
    <VBtn block class="bg-black" @click="emit('hideDialog')">Done</VBtn>
  </VCardActions>
</VCard>
</template>

<style scoped>

</style>