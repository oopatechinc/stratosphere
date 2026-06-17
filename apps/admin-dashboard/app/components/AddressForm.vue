<script setup lang="ts">

import {useCountriesStore} from "#imports";
import type { Address } from "#bookisia-shared-module/types";

const {genericRequiredRule} = useValidationRules()
const countryStore = useCountriesStore()
countryStore.fetch('?is_active=1&appendStates=true')

const {t} = useI18n()

const {countries} = storeToRefs(countryStore)

const address = defineModel<Address>()

const selectedCountry = computed(() => {
  return countries.value?.find(c => c.id === address.value?.country_id)
})

const provinceLabel = computed(() => {
  if (!selectedCountry.value?.geographical_unit_name) {
      return t('app.address.province')
  }

  return t(`app.address.${selectedCountry.value.geographical_unit_name}`)
})
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VSelect
          v-model="address!.country_id"
          :label="$t('app.address.country')"
          :items="countries"
          item-title="name"
          item-value="id"
          variant="outlined"
          density="compact"
          :rules="genericRequiredRule(t('app.address.validations.country'))"
      />
    </VCol>
    <VCol cols="12">
      <VTextField
          v-model="address!.address_line_1"
          :label="$t('app.address.address_line', {address_line: 1})"
          variant="outlined"
          density="compact"
          :rules="genericRequiredRule(t('app.address.validations.address'))"
      />
    </VCol>
    <VCol cols="12">
      <VTextField
          v-model="address!.address_line_2"
          :label="$t('app.address.address_line', {address_line: 2})"
          variant="outlined"
          density="compact"
      />
    </VCol>
    <VCol cols="12">
      <VTextField
          v-model="address!.city"
          :label="$t('app.address.city')"
          variant="outlined"
          density="compact"
          :rules="genericRequiredRule(t('app.address.validations.city'))"
      />
    </VCol>
    <VCol cols="12" md="6">
      <VSelect
          v-model="address!.state_id"
          :label="provinceLabel"
          variant="outlined"
          density="compact"
          :items="selectedCountry?.states"
          item-title="name"
          item-value="id"
          :rules="genericRequiredRule(t('app.address.validations.province'))"
      />
    </VCol>
    <VCol cols="12" md="6">
      <VTextField
          v-model="address!.postal_code"
          :label="$t('app.address.post_code')"
          variant="outlined"
          density="compact"
          :rules="genericRequiredRule(t('app.address.validations.post_code'))"
      />
    </VCol>
  </VRow>
</template>

