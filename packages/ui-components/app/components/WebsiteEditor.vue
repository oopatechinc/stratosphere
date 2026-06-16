<script setup lang="ts">
import { useEditorStore } from '@/stores/editor'
import { useLayoutStore } from '@/stores/layout'

definePageMeta({
  layout: 'blank'
})

const route = useRoute()
const editorStore = useEditorStore()
const layoutStore = useLayoutStore()

onMounted(async () => {
  await editorStore.fetchWebsite(Number(route.params.id))
})

const isSidebarVisible = computed({
  get: () => layoutStore.sidebarState !== 'hidden',
  set: (val) => {
    if (!val) layoutStore.setSidebarState('hidden')
    else if (layoutStore.sidebarState === 'hidden') layoutStore.setSidebarState('half')
  }
})
</script>

<template>
  <v-app v-if="editorStore.website">
    <!-- Sidebar -->
    <v-navigation-drawer
      v-model="isSidebarVisible"
      :width="layoutStore.sidebarWidth"
      permanent
      border="none"
      class="editor-sidebar-glass"
      elevation="0"
    >
      <EditorSidebar />
    </v-navigation-drawer>

    <!-- Main Content (Preview Area) -->
    <v-main class="bg-grey-lighten-4 overflow-hidden" style="height: 100vh;">
      <div
        class="d-flex flex-column align-center justify-center relative transition-all duration-500"
        style="height: 100%; width: 100%;"
        :style="{
          padding: layoutStore.isPreviewMode ? '0' : '48px'
        }"
      >
        <div
          class="preview-container elevation-24 bg-white transition-all overflow-y-auto overflow-x-hidden"
          :style="{
            width: layoutStore.previewWidth,
            height: '100%',
            opacity: layoutStore.sidebarState === 'full' ? '0' : '100%',
            transform: layoutStore.sidebarState === 'full' ? 'scale(0.95)' : 'scale(1)',
            transitionDuration: '500ms',
            borderRadius: layoutStore.isPreviewMode && layoutStore.previewDevice === 'desktop' ? '0' : '12px'
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

        <EditorToolbar />
      </div>
    </v-main>
  </v-app>
  <div v-else class="fill-height d-flex align-center justify-center bg-grey-darken-4">
    <v-progress-circular indeterminate color="primary" size="64" />
  </div>
</template>

<style scoped>
.editor-sidebar-glass {
  background: #0f172a !important; /* Solid dark background for sidebar */
  color: white;
}

.preview-container {
  max-width: 1440px;
  border: 1px solid rgba(0,0,0,0.05);
  margin: 0 auto;
  position: relative;
  flex-shrink: 1; /* Allow shrinking if needed */
  min-height: 0;   /* Essential for overflow-y to work in flex */
}

/* Custom scrollbar */
.preview-container::-webkit-scrollbar {
  width: 8px;
}
.preview-container::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.02);
}
.preview-container::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.15);
  border-radius: 10px;
}
.preview-container::-webkit-scrollbar-thumb:hover {
  background: rgba(0, 0, 0, 0.25);
}

.transition-all {
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.h-full {
  height: 100%;
}
</style>
