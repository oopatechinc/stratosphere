<script setup lang="ts">
import type {Occupation} from "#bookisia-shared-module/types";

const {genericRequiredRule} = useValidationRules()
const {tenant} = storeToRefs(useTenantStore())

const emit = defineEmits(['hideDialog']);

const {store} = useOccupationsStore()

const formValidity = ref(null)
const form = ref<Occupation>({
  tenant_id: tenant.value!.id!,
  title: ''
})

async function submit() {
  if (formValidity.value !== true) return

  await store(form.value)
  emit('hideDialog')
}
</script>

<template>
  <VCard flat>
    <VCardTitle class="d-flex justify-space-between">
      <h3 class="mb-3">Create Job</h3>
      <VBtn icon="mdi-close" flat @click="emit('hideDialog')"/>
    </VCardTitle>
    <VCardText>
      <VForm v-model="formValidity" validate-on="blur" @submit.prevent="submit">
        <VTextField
            v-model="form.title"
            variant="outlined"
            density="compact"
            append-inner-icon="mdi-information"
            label="Job Title"
            :rules="genericRequiredRule('Job title is required')"
        />
        <div class="d-flex justify-end">
          <VBtn color="primary" text="submit" type="submit"/>
        </div>
      </VForm>
    </VCardText>
  </VCard>
</template>

<style scoped>
.v-stepper-header {
  box-shadow: none !important;
}
</style>

