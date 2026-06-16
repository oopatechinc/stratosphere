<script setup lang="ts">
import { ref, onMounted } from 'vue'

const props = defineProps<{
  tenantId: number
}>()

const emit = defineEmits<{
  (e: 'select', url: string): void
  (e: 'close'): void
}>()

const media = ref<any[]>([])
const loading = ref(false)
const uploading = ref(false)
const fileInput = ref<HTMLInputElement | null>(null)

async function fetchMedia() {
  loading.value = true
  const client = useSanctumClient()
  try {
    const data = await client<any[]>('/api/media')
    media.value = data
  } catch (error) {
    console.error('Failed to fetch media', error)
  } finally {
    loading.value = false
  }
}

async function handleUpload(event: Event) {
  const target = event.target as HTMLInputElement
  if (!target.files?.length) return

  uploading.value = true
  const client = useSanctumClient()
  const formData = new FormData()
  formData.append('file', target.files[0])
  formData.append('tenant_id', props.tenantId.toString())

  try {
    const newMedia = await client<any>('/api/media', {
      method: 'POST',
      body: formData
    })
    media.value.unshift(newMedia)
  } catch (error) {
    console.error('Upload failed', error)
  } finally {
    uploading.value = false
  }
}

async function deleteMedia(id: number) {
  const client = useSanctumClient()
  try {
    await client(`/api/media/${id}`, { method: 'DELETE' })
    media.value = media.value.filter(m => m.id !== id)
  } catch (error) {
    console.error('Delete failed', error)
  }
}

onMounted(fetchMedia)
</script>

<template>
  <v-card class="media-library-card bg-grey-darken-4 text-white rounded-3xl overflow-hidden">
    <v-card-title class="d-flex align-center justify-space-between pa-6">
      <span class="text-h5 font-outfit">Media Library</span>
      <v-btn icon="mdi-close" variant="text" @click="emit('close')" />
    </v-card-title>

    <v-divider />

    <div class="pa-6">
      <div class="d-flex align-center ga-4 mb-8">
        <v-btn
          color="primary"
          prepend-icon="mdi-upload"
          rounded="xl"
          :loading="uploading"
          @click="fileInput?.click()"
        >
          Upload Image
        </v-btn>
        <input
          ref="fileInput"
          type="file"
          class="d-none"
          accept="image/*"
          @change="handleUpload"
        />
        <v-spacer />
        <v-btn icon="mdi-refresh" variant="text" @click="fetchMedia" :loading="loading" />
      </div>

      <v-row v-if="media.length">
        <v-col v-for="item in media" :key="item.id" cols="4" sm="3" md="2">
          <v-hover v-slot="{ isHovering, props }">
            <v-card
              v-bind="props"
              class="media-item position-relative rounded-xl border-md transition-all cursor-pointer overflow-hidden"
              :class="isHovering ? 'border-primary' : 'border-transparent'"
              @click="emit('select', item.url)"
            >
              <v-img :src="item.url" aspect-ratio="1" cover />
              
              <v-fade-transition>
                <div v-if="isHovering" class="overlay position-absolute inset-0 d-flex align-center justify-center">
                  <v-btn
                    icon="mdi-delete"
                    color="error"
                    size="small"
                    variant="flat"
                    @click.stop="deleteMedia(item.id)"
                  />
                </div>
              </v-fade-transition>
            </v-card>
          </v-hover>
        </v-col>
      </v-row>
      
      <div v-else-if="!loading" class="text-center py-12 opacity-50">
        <v-icon size="64" class="mb-4">mdi-image-multiple-outline</v-icon>
        <p>No media found. Upload your first image!</p>
      </div>

      <div v-else class="d-flex justify-center py-12">
        <v-progress-circular indeterminate color="primary" />
      </div>
    </div>
  </v-card>
</template>

<style scoped>
.media-library-card {
  min-height: 60vh;
}
.media-item {
  aspect-ratio: 1;
}
.overlay {
  background: rgba(0, 0, 0, 0.4);
}
.inset-0 {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}
</style>
