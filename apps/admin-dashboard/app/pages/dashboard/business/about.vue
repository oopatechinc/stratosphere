<script setup lang="ts">
import {useLanguagesStore, useTenantStore, useSanctumUser} from "#imports";
import type {User} from "@stratosphere/core-layer/types";

const {genericRequiredRule} = useValidationRules()
const {fetchTenantById, update} = useTenantStore()
const {tenant} = storeToRefs(useTenantStore())
const user = useSanctumUser<User>()

await fetchTenantById(user.value!.tenant_id!)
const {displaySuccessMessage, displayErrorMessage} = useSnackbarStore()
const languagesStore = useLanguagesStore()
await languagesStore.fetch()

const {languages} = storeToRefs(languagesStore)

const items = computed(() => {
  return [
    {
      type: 'textfield',
      key: "name",
      label: "Display Business Name",
      value: tenant?.value?.name
    },
    {
      type: 'textfield',
      key: '',
      label: "Preferred Business Owner Name",
      value: ""
    },
    {
      type: 'select',
      key: 'language_id',
      label: "Language",
      value: languages.value.find(l => l.id === tenant.value?.language_id)?.language
    }
  ]
})

interface KEY_VAL{
  type: string,
  key: string,
  label: string,
  value: string
}

const showEditDialog = ref(false)
const currentItem = ref<KEY_VAL>()
const form = ref()
const formValidity = ref(null)

function handleEdit(item: KEY_VAL) {
  currentItem.value = item
  form.value = item.value
  showEditDialog.value = true
}

async function submit() {
  if (formValidity.value !== true) return
  let error = false
  await update(tenant.value!.id!, {[currentItem.value!.key]: form.value}).catch(() => {
    error = true
  })

  if (error) {
    return displayErrorMessage('Business update failed')
  }

  showEditDialog.value = false
  displaySuccessMessage('Your business has been updated successfully')
}
</script>

<template>
<div>
  <h3 class="ml-4 my-4">About</h3>
  <VCard class="border-dashed" flat>
    <VCardText>
      <small>Manage your business and account settings</small>
      <VTable class="my-4">
        <tbody>
        <tr
            v-for="item in items"
            :key="item.key"
        >
          <td class="w-25"><span class="font-weight-bold">{{ item.label }}</span></td>
          <td>{{ item.value }}</td>
          <td class="text-end">
            <VBtn text="Edit" variant="outlined" @click="handleEdit(item)" />
          </td>
        </tr>
        </tbody>
      </VTable>

      <div>
        <VDivider class="my-6"/>
        <h3>Deactivate your business</h3>
        <p class="my-3">Deactivating your business account is permanent; you will lose all access to your payment history and account data</p>

        <VBtn variant="outlined" color="red">Deactivate your business</VBtn>
      </div>
    </VCardText>
  </VCard>

  <VDialog v-model="showEditDialog" max-width="600">
    <VCard>
      <VCardTitle class="d-flex justify-space-between">
        <span class="mt-2">Edit {{currentItem?.label}}</span>
        <VBtn flat icon="mdi-close" @click="showEditDialog=false"/>
      </VCardTitle>
      <VCardText>
        <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="submit">
          <VTextField
              v-if="currentItem?.type === 'textfield'"
              v-model="form"
              :label="currentItem?.label"
              :rules="genericRequiredRule(currentItem?.label + ' is required')"
          />
          <VSelect
              v-else
              v-model="form"
              :items="languages"
              item-title="language"
              item-value="id"
              :label="currentItem?.label"
              :rules="genericRequiredRule(currentItem?.label + ' is required')"
          />
          <VBtn color="primary" text="Submit" block  type="submit" />
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>
</div>
</template>

<style scoped>
.v-table {
  border: lightgrey 1px solid;
}
</style>