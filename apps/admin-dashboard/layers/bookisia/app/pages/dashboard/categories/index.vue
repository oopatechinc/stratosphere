<script setup lang="ts">
const store = useCategoriesStore()
const {encrypter} = useUtils()

const minimumShowFooterLength = 11

//init the categories store
await store.get()
const {categories} = storeToRefs(store)

const headers = [
  { title: 'Name', value: 'name' },
  { title: 'Associated Services Count', value: 'serviceCount' },
  { title: '', value: 'action' },
]

function goto(itemId: number) {
  navigateTo(`/dashboard/categories/${encrypter(String(itemId))}`)
}

</script>

<template>
  <div class="container pa-2">
    <div v-if="categories.length !== 0" class="d-flex justify-space-between">
      <h3>Categories</h3>
      <VBtn rounded color="black" flat to="/dashboard/categories/new">{{$t('app.categories.action_btn')}}</VBtn>
    </div>

    <VCard v-if="categories.length === 0">
      <VCardText class="d-flex justify-center">
        <div class="text-center">
          <VIcon size="60">mdi-folder-outline</VIcon>
          <h3 class="mt-3 mb-2">{{$t('app.dictionary.categories')}}</h3>
          <p class="mb-2">{{$t('app.categories.explanation')}}</p>
          <VBtn color="primary" to="/dashboard/categories/new">{{$t('app.categories.action_btn')}}</VBtn>
        </div>
      </VCardText>
    </VCard>
    <VCard v-else class="mt-10">
      <VDataTable :headers="headers" :items="categories" :hide-default-footer="categories.length < minimumShowFooterLength" hover>
        <template #item="{ item }">
          <tr class="text-no-wrap" @click="goto(item.id!)">
            <td class="d-flex pt-1">
              <VAvatar size="40">
                <VImg v-if="item.image_url" :src="item.image_url" />
                <VIcon v-else size="40">mdi-image</VIcon>
              </VAvatar>
              <p class="ml-4 mt-2">{{ item.name }}</p>
            </td>
            <td>
              <VChip :text="item?.services?.length || 'None'" :color="item?.services?.length? 'success': ''" />
            </td>
            <td class="text-end"><VIcon>mdi-chevron-right</VIcon></td>
          </tr>
        </template>
      </VDataTable>
    </VCard>
  </div>
</template>

<style scoped>

</style>