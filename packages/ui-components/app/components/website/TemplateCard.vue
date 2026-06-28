<script setup lang="ts">
defineProps({
  template: {
    type: Object,
    required: true
  }
})

</script>

<template>
  <VCard elevation="6" width="400" height="600">
    <VCardTitle>
        Realio Theme 1
    </VCardTitle>
    <VImg
        class="align-end text-white"
        :src="template.image_url"
        cover
    />
  </VCard>
</template>

<style scoped>

</style>