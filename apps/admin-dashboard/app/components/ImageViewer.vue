<script setup lang="ts">
import {useI18n} from "#imports";

const properties = defineProps({
  imageUrl: {
    type: String,
    required: true
  },
  entityType: {
    type: String,
    required: true
  },
  entityId: {
    type: Number,
    required: true
  }
})

const {previewImage, filesToUpload, tempImages} = useImageUpload()
const {send} = useFileService()
const {displayErrorMessage, displaySuccessMessage} = useSnackbarStore()
const fileInput = ref()
const {t} = useI18n()

const currentImageUrl = computed(() => {
  if (tempImages.value.length) {
    return tempImages.value[0]
  }

  return properties.imageUrl
})

const items = computed(() => {
  return [
    t('app.dictionary.upload'),
    t('app.dictionary.remove')
  ]
})


function handleOptionClick(option: string) {
  if (option === 'Upload') {
    fileInput.value.click()
  }
}

async function handleImageUpload(event: Event) {
  previewImage(event)

  if (filesToUpload.value.length === 0 ) return

  // now upload image
  let error = false
  const model = await send(filesToUpload.value[0], properties.entityType, properties.entityId, 'replace').catch(() => {
    error = true
  })

  if (error) {
    return displayErrorMessage('There was an error while uploading the image')
  }

  displaySuccessMessage('Image successfully updated')
  return model
}
</script>

<template>
  <VCard class="d-flex justify-center ma-1">
    <div>
      <VAvatar size="100">
        <VImg :src="currentImageUrl" />
      </VAvatar>
      <div class="d-flex justify-center mt-4">
        <VMenu location="bottom">
          <template #activator="{ props }">
            <VBtn
                variant="text"
                v-bind="props"
                :text="$t('app.dictionary.edit')"
                width="100"
            />
          </template>

          <VList>
            <VListItem
                v-for="(item, index) in items"
                :key="index"
                :value="index"
                @click="handleOptionClick(item)"
            >
              <VListItemTitle>{{ item }}</VListItemTitle>
            </VListItem>
          </VList>
        </VMenu>

        <input ref="fileInput" type="file" style="display: none" @change="handleImageUpload">
      </div>
    </div>
  </VCard>
</template>

<style scoped>

</style>