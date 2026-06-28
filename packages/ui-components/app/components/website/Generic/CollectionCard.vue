<script setup lang="ts">
interface Props {
  item: object,
  sectionId: string
}
defineProps<Props>()
</script>

<template>
  <GenericCollectionCardProperty
      v-if="sectionId=='dynamic_properties'"
      :item="item"
      :show-edit-buttons="false"
      :flat="true"
  />
</template>