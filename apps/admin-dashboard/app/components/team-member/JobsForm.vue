<script setup lang="ts">
import type {Occupation, User} from "#bookisia-shared-module/types";

const user = useSanctumUser<User>()

const jobs = defineModel<Occupation[]>()

function handleAddAnotherJob() {
  const newJob = {
    business_id: user.value?.staff?.business_id,
    title: ''
  } as Occupation

  jobs.value!.push(newJob)
}
</script>

<template>
  <div class="d-flex justify-end">
    <VBtn
        class="mb-3"
        color="primary"
        variant="outlined"
        prepend-icon="mdi-plus"
        text="Add another"
        @click="handleAddAnotherJob"
    />
  </div>
  <template v-for="i in jobs?.length" :key="i">
    <JobForm v-model="jobs![i-1]"/>
  </template>
</template>

<style scoped>

</style>