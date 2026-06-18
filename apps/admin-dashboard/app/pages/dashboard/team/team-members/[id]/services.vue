<script setup lang="ts">

import type {Service} from "@stratosphere/core-layer/types";
import {useUtils} from "#imports";

const {syncServices} = useStaffsStore()

const {tenant} = storeToRefs(useTenantStore())

const {decrypter} = useUtils()

const showAddNewServiceDialog = ref(false)

const currentStaff = tenant.value!.staff!.find(s => s.id === Number(decrypter(String(useRoute().params.id))))

const selectedServices = ref<Service[]>([...currentStaff!.services!])

async function submit() {
  await syncServices(currentStaff!.id!, selectedServices.value as Service[])
  currentStaff!.services! = selectedServices.value
  showAddNewServiceDialog.value = false
}

</script>

<template>
  <VDialog :model-value="true" scrollable fullscreen>
    <VCard>
        <VCardTitle class="d-flex justify-space-between">
          <VBtn icon flat to="/dashboard/team/team-members">
            <VIcon>mdi-close</VIcon>
          </VBtn>
          <VBtn flat variant="outlined" rounded @click="showAddNewServiceDialog=true">
            Modify Services
          </VBtn>
        </VCardTitle>

        <VCardText>
          <h2 class="my-6">Andrew's Services</h2>
          <ServicesDataTable :services="currentStaff!.services!" />
        </VCardText>
    </VCard>

    <VDialog v-model="showAddNewServiceDialog" max-width="600">
      <VCard>
        <VCardTitle class="d-flex justify-space-between">
          Add new service
          <VBtn icon="mdi-close" flat />
        </VCardTitle>
        <VCardText>
          <VSelect
              v-model="selectedServices"
              :items="tenant!.services"
              item-title="name"
              multiple
              return-object
          />

          <div class="d-flex justify-end">
            <VBtn text="Update" color="primary" @click="submit"/>
          </div>

        </VCardText>
      </VCard>
    </VDialog>
  </VDialog>

</template>

<style scoped>

</style>