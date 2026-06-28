<script setup lang="ts">
import { ref } from 'vue'

const props = defineProps<{
  modelValue: string
  label: string
  tenantId: number
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const showLibrary = ref(false)

function onSelect(url: string) {
  emit('update:modelValue', url)
  showLibrary.value = false
}
</script>

<template>
  <div class="media-picker">
    <label class="d-block text-caption font-weight-bold text-uppercase opacity-50 mb-2">{{ label }}</label>

    <div class="d-flex ga-2">
      <div 
        class="preview-box w-16 h-16 rounded-xl custom-card d-flex align-center justify-center overflow-hidden cursor-pointer hover:border-primary/50 transition-all"
        @click="showLibrary = true"
      >
        <v-img v-if="modelValue" :src="modelValue" cover />
        <v-icon v-else opacity="40">mdi-image-plus</v-icon>
      </div>

      <div class="flex-grow-1">
        <v-text-field
          :model-value="modelValue"
          @update:model-value="emit('update:modelValue', $event)"
          variant="outlined"
          density="comfortable"
          hide-details
          placeholder="Enter image URL or select"
          class="rounded-lg mb-2"
        />
        <v-btn 
          variant="text" 
          size="x-small" 
          prepend-icon="mdi-library-movie" 
          color="primary"
          class="text-none"
          @click="showLibrary = true"
        >
          Open Library
        </v-btn>
      </div>
    </div>

    <v-dialog v-model="showLibrary" max-width="900">
      <MediaLibrary :tenant-id="tenantId" @select="onSelect" @close="showLibrary = false" />
    </v-dialog>
  </div>
</template>

<style scoped>
.preview-box {
  flex-shrink: 0;
  width: 64px;
  height: 64px;
}

.custom-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
}
</style>
