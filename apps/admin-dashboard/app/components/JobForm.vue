<script setup lang="ts">
import {useSanctumUser} from "#imports";
import type {Occupation, User} from "#bookisia-shared-module/types";

const {genericRequiredRule} = useValidationRules()
const occupationsStore = useOccupationsStore()
const {occupations} = storeToRefs(occupationsStore)
const user = useSanctumUser<User>()

occupationsStore.get(`?tenant_id=${user.value?.staff?.tenant_id}`)

const job = defineModel<Occupation>()
const showCreateJobForm = ref(false)
</script>

<template>
  <VCard class="ma-1">
    <VCardText>
      <VRow no-gutters>
        <VCol cols="4">
          <VCard class="bg-grey-lighten-3" tile height="56px" flat>
            <VCardText>
              <label >Primary Job</label>
            </VCardText>
          </VCard>
        </VCol>
        <VCol cols="8">
          <VSelect
              v-model="job"
              :items="occupations"
              label="Choose job"
              class="bg-white"
              variant="solo-filled"
              tile
              flat
              :rules="genericRequiredRule('Job is required')"
              return-object
          >
            <template #prepend-item>
              <VBtn
                  variant="text"
                  flat
                  class="text-decoration-underline"
                  text="Create new job"
                  @click="showCreateJobForm=true"
              />

              <VDivider class="mt-2" />
            </template>
          </VSelect>
        </VCol>
      </VRow>
    </VCardText>
  </VCard>
  <VDialog v-model="showCreateJobForm" max-width="600">
    <CreateJobForm @hide-dialog="showCreateJobForm=false" />
  </VDialog>
</template>

<style scoped>
.v-stepper-header {
  box-shadow: none !important;
}
</style>

