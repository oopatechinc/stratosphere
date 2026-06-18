<script setup lang="ts">
import type {User} from "@stratosphere/core-layer/types";
import {VPhoneInput} from "v-phone-input";

const {genericRequiredRule} = useValidationRules()


const user = defineModel<User>({default: {
    first_name: '',
    last_name: '',
    email: '',
    phone: ''
  }
})
</script>

<template>
  <VRow>
    <VCol cols="12" md="6">
      <VTextField
          v-model="user.first_name"
          variant="outlined"
          density="compact"
          :label="$t('app.forms.person.first_name')"
          append-inner-icon="mdi-information"
          :rules="genericRequiredRule($t('app.forms.person.validations.first_name_required'))"
      />
    </VCol>
    <VCol cols="12" md="6">
      <VTextField
          v-model="user.last_name"
          :label="$t('app.forms.person.last_name')"
          variant="outlined"
          density="compact"
          :rules="genericRequiredRule($t('app.forms.person.validations.last_name_required'))"
      />
    </VCol>
    <VCol cols="12" md="6">
      <VPhoneInput
          v-model="user.phone"
          :label="$t('app.forms.person.phone_number')"
          density="compact"
          :guess-country="true"
          :enable-searching-country="true"
          :rules="genericRequiredRule($t('app.forms.person.validations.phone_number_required'))"
      />

    </VCol>
    <VCol cols="12" md="6">
      <VTextField
          v-model="user.email"
          :label="$t('app.forms.person.email')"
          variant="outlined"
          density="compact"
          :rules="genericRequiredRule($t('app.forms.person.validations.email_required'))"
      />
    </VCol>
  </VRow>
</template>

<style scoped>
.v-stepper-header {
  box-shadow: none !important;
}
</style>

