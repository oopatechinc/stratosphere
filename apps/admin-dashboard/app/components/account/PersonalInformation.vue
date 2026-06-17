<script setup lang="ts">
import type {User} from "#bookisia-shared-module/types"
import {useLanguagesStore, useTimezonesStore} from "#imports"
import {isEqual} from "lodash-es"

const client = useSanctumClient()

// fetches
const languagesStore = useLanguagesStore()
await languagesStore.fetch()

const timezonesStore = useTimezonesStore()
await timezonesStore.fetch()

const {languages} = storeToRefs(languagesStore)
const {timezones} = storeToRefs(timezonesStore)

const user = useSanctumUser<User>()
const clonedUser = ref({...user.value})

const {displaySuccessMessage, displayErrorMessage} = useSnackbarStore()

const isUpdated = computed(() => {
  return !isEqual(user.value, clonedUser.value)
})

async function update() {
  let error = false
  await client<User>(`/users/${user.value?.id}`, {method: 'PUT', body: user.value}).catch(() => {
    error = true
  })

  if (error) {
    return displayErrorMessage('There was an error while updating your personal information')
  }

  clonedUser.value = {...user.value}

  displaySuccessMessage('Personal information updated successfully')

}
</script>

<template>
  <VCard max-width="1200" class="mx-auto" flat>
    <VCardTitle class="d-flex">
      <VSpacer />
      <VBtn
          rounded
          :text="$t('app.dictionary.update')"
          prepend-icon="mdi-cloud-upload"
          color="primary"
          :disabled="!isUpdated"
          @click="update"
      />
    </VCardTitle>
    <VCardText>
      <AccountProfile />
      <VRow>
        <VCol>
          <h3 class="mt-4">{{$t('app.account.language_preferences')}}</h3>
          <VSelect
              v-model="user!.preferred_language_id"
              :items="languages"
              :label="$t('app.account.select_language')"
              item-title="language"
              item-value="id"
          />
        </VCol>
        <VCol>
          <h3 class="mt-4">{{$t('app.account.timezone_preferences')}}</h3>
          <VSelect
              v-model="user!.timezone_id"
              :items="timezones"
              :label="$t('app.account.select_timezone')"
              item-title="timezone"
              item-value="id"
          />
        </VCol>
      </VRow>
    </VCardText>
  </VCard>
</template>

<style scoped>

</style>