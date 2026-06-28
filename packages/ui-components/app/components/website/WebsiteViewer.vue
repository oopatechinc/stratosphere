<script setup lang="ts">
import { useEditorStore } from '@/stores/editor'

definePageMeta({
  layout: 'blank'
})


interface Props {
  websiteId?: number
  source: 'admin' | 'frontpage'
}

const props = defineProps<Props>()

const route = useRoute()
const editorStore = useEditorStore()

const websiteId = props.source === 'frontpage' ? props.websiteId : props.source === 'admin' ? route.params.id : null

if (websiteId) {
  await editorStore.fetchWebsite(Number(websiteId))
}

</script>

<template>
  <v-app v-if="editorStore.website">
    <!-- Main Content (Preview Area) -->
    <div class="bg-grey-lighten-4 overflow-hidden" style="height: 100vh;">
      <div
        class="relative transition-all duration-500"
        style="height: 100%; width: 100%;"
      >
        <div
          class="elevation-24 bg-green transition-all overflow-y-auto overflow-x-hidden"
          style="opacity: 100%; transform: scale(1)"
          :style="{
            width: '100%',
            height: '100%',
            transitionDuration: '500ms',
          }"
        >
          <div v-if="editorStore.draftConfig" class="relative">
            <SectionRenderer
              v-for="section in editorStore.draftConfig.sections"
              :key="section.id"
              :section="section"
            />
          </div>
          <div v-else class="h-full d-flex align-center justify-center">
            <v-progress-circular indeterminate color="primary" />
          </div>
        </div>
      </div>
    </div>
  </v-app>
  <div v-else class="fill-height d-flex align-center justify-center bg-grey-darken-4">
    <v-progress-circular indeterminate color="primary" size="64" />
  </div>
</template>

<style scoped>
.transition-all {
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.h-full {
  height: 100%;
}
</style>
