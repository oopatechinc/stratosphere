<script setup lang="ts">
import type {Service, ServiceVariation} from "#bookisia-shared-module/types";

const localePath = useLocalePath()
const {encrypter} = useUtils()
const {t} = useI18n()

interface Props {
  services: Service[]
}

const props = defineProps<Props>()

const minimumShowFooterLength = 11

const headers = computed(() => {
  return [
    {title: t('app.dictionary.name'), value: 'name'},
    {title: t('app.dictionary.description'), value: 'description'},
    {title: t('app.dictionary.price'), value: 'price'},
    {title: t('app.dictionary.duration'), value: 'duration'},
    {title: '', value: 'action'},
  ]
})

function getMinimumPrice(variations: ServiceVariation[]) {
  const sorted = variations.sort((a, b) => a.price - b.price)
  return sorted[0]?.price ?? 0
}

function getMinimumDuration(variations: ServiceVariation[]) {
  const sorted = variations.sort((a, b) => a.duration - b.duration)
  return sorted[0]?.duration ?? 0
}

function goto(itemId: number) {
  useRouter().push(localePath(`/dashboard/services/${encrypter(String(itemId))}`))
}

</script>
<template>
  <VDataTable
      :headers="headers"
      :items="props.services"
      :hide-default-footer="!services || services.length < minimumShowFooterLength"
      hover
  >
    <template #item="{ item }">
      <tr class="text-no-wrap" @click="goto(item.id!)">
        <td class="d-flex">
          <VAvatar size="40">
            <VImg v-if="item.image_url" :src="item.image_url"/>
            <VIcon v-else size="40">mdi-image</VIcon>
          </VAvatar>
          <p class="ml-4 mt-2">{{ item.name }}</p>
        </td>
        <td>{{ item.description }}</td>
        <td>${{ getMinimumPrice(item.variations as ServiceVariation[]) }}+</td>
        <td>{{ getMinimumDuration(item.variations as ServiceVariation[]) }} mins +</td>
        <td class="text-end">
          <VIcon>mdi-chevron-right</VIcon>
        </td>
      </tr>
    </template>
  </VDataTable>
</template>
<style scoped>

</style>