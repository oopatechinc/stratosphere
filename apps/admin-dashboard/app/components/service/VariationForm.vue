<script setup lang="ts">
import type {ServiceVariation} from "@stratosphere/core-layer/types";

const {genericRequiredRule} = useValidationRules()

const props = defineProps({
  isDialog: {
    type: Boolean,
    default: false
  }
})

const variation = defineModel<ServiceVariation>({default: {name: '', duration: 30, price: 0}})
</script>

<template>
  <VRow class="mb-10">
    <VCol cols="12">
      <h4>{{$t('app.dictionary.price')}}</h4>
      <VTextField
          v-model="variation.price"
          variant="outlined"
          density="compact"
          item-title="name"
          :rules="genericRequiredRule('At least one category is required')"
          multiple
      />
    </VCol>

    <VCol cols="12">
      <h4>{{$t('app.dictionary.duration')}}</h4>
      <CommonTimeSlider v-model="variation.duration"/>
    </VCol>

    <VCol v-if="props.isDialog" cols="12">
      <h4>Variation Name</h4>
      <VTextField
          v-model="variation.name"
          variant="outlined"
          density="compact"
          item-title="name"
          :rules="genericRequiredRule('At least one category is required')"
          multiple
      />
    </VCol>
  </VRow>

</template>

<style scoped>

</style>