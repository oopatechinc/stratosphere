<script setup lang="ts">
import {useImageUpload} from "#imports";

const fileInput = ref()
const {previewImage} = useImageUpload()

const emit = defineEmits(['base64FileCreated'])

</script>

<template>
  <input ref="fileInput" type="file" style="display: none" @change="previewImage" />

</template>

<style scoped>

</style>