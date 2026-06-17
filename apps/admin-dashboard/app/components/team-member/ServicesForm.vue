<script setup lang="ts">
import type {Service, User} from "#bookisia-shared-module/types"
import {useServicesStore, useValidationRules} from "#imports";

const {genericRequiredRule} = useValidationRules()
const user = useSanctumUser<User>()
const {fetch} = useServicesStore()
const {services: businessServices} = storeToRefs(useServicesStore())

fetch(`?business_id=${user.value?.staff?.business_id}`)

const services = defineModel<Service[]>()
</script>

<template>
  <div class="d-flex my-4">
    <VIcon color="primary" class="mr-3">mdi-information</VIcon>
    <p>Set the services for this team member</p></div>
  <VSelect
      v-model="services"
      :items="businessServices"
      item-title="name"
      label="Staff services"
      chips
      closable-chips
      multiple
      variant="outlined"
      :rules="genericRequiredRule('Staff service is required')"
      return-object
  />
</template>

<style scoped>

</style>