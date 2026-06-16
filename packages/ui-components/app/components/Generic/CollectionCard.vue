<script setup lang="ts">
interface Props {
  item: object,
  sectionId: string
}
const props = defineProps<Props>()

console.log('items', props.item)
</script>

<template>
  <GenericCollectionCardProperty v-if="sectionId=='dynamic_properties'" :item="item"/>
</template>