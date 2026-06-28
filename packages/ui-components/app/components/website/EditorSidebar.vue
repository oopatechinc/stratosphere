<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import { useEditorStore } from '@/stores/editor'
import { useLayoutStore } from '@/stores/layout'

const editorStore = useEditorStore()
const layoutStore = useLayoutStore()

const activeSectionId = ref<string | null>(null)
const tab = ref('content')
const showAddModal = ref(false)
const draggedIndex = ref<number | null>(null)

watch(activeSectionId, (newId) => {
  if (newId) {
    // Small delay to ensure the component is rendered (if it wasn't) 
    // and to allow sidebar transition
    setTimeout(() => {
      const el = document.getElementById(newId)
      if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'center' })
        // Add a temporary highlight effect
        el.classList.add('section-highlight')
        setTimeout(() => el.classList.remove('section-highlight'), 2000)
      }
    }, 100)
  }
})

const activeSection = computed(() => {
  return editorStore.draftConfig?.sections?.find((s: any) => s.id === activeSectionId.value)
})

const activeBlueprintSection = computed(() => {
  if (!activeSection.value) return null
  const type = activeSection.value.type || editorStore.blueprint?.schema?.sections?.find((s: any) => s.id === activeSection.value.id)?.type
  return editorStore.blueprint.schema.sections.find((s: any) => s.type === type)
})

function closeSection() {
  activeSectionId.value = null
}

function handleAddSection(type: string) {
  editorStore.addSection(type)
  showAddModal.value = false
}

function handleRemoveSection(id: string) {
  editorStore.removeSection(id)
  if (activeSectionId.value === id) activeSectionId.value = null
}

// Drag and Drop Logic
function onDragStart(index: number) {
  draggedIndex.value = index
}

function onDragOver(event: DragEvent, index: number) {
  event.preventDefault()
  if (draggedIndex.value === null || draggedIndex.value === index) return

  const sections = [...editorStore.draftConfig.sections]
  const [movedSection] = sections.splice(draggedIndex.value, 1)
  sections.splice(index, 0, movedSection)
  
  editorStore.reorderSections(sections)
  draggedIndex.value = index
}

function onDragEnd() {
  draggedIndex.value = null
}

const menuItems = [
  { id: 'sections', icon: 'mdi-view-quilt', label: 'Sections' },
  { id: 'theme', icon: 'mdi-palette', label: 'Theme' },
  { id: 'pages', icon: 'mdi-file-multiple', label: 'Pages' },
  { id: 'settings', icon: 'mdi-cog', label: 'Settings' },
]
</script>

<template>
  <div class="d-flex h-100 overflow-hidden">
    <!-- Mini Rail -->
    <div class="d-flex flex-column align-center py-6 bg-grey-darken-4 border-e border-white/10" style="width: 64px; gap: 16px;">
      <v-btn
        v-for="item in menuItems"
        :key="item.id"
        :icon="item.icon"
        variant="text"
        :color="layoutStore.activeMenu === item.id ? 'primary' : 'white'"
        class="opacity-80"
        @click="layoutStore.setActiveMenu(item.id as any)"
      >
        <v-tooltip activator="parent" location="right">{{ item.label }}</v-tooltip>
        <v-icon>{{ item.icon }}</v-icon>
      </v-btn>
    </div>

    <!-- Content Area -->
    <div class="flex-grow-1 d-flex flex-column pa-6 overflow-hidden">
      <!-- Header -->
      <div class="d-flex align-center justify-space-between mb-8">
        <h1 class="text-h6 font-weight-bold font-outfit text-capitalize">{{ layoutStore.activeMenu }}</h1>
        <v-btn icon="mdi-chevron-left" variant="text" size="small" @click="layoutStore.setSidebarState('hidden')" />
      </div>

      <!-- Sections Menu -->
      <template v-if="layoutStore.activeMenu === 'sections'">
        <!-- Section List -->
        <div v-if="!activeSectionId" class="flex-grow-1 overflow-y-auto">
          <div class="mb-4 d-flex align-center justify-space-between">
            <span class="text-caption font-weight-bold text-uppercase tracking-wider opacity-60">Your Sections</span>
            <v-btn size="x-small" prepend-icon="mdi-plus" color="primary" rounded variant="flat" @click="showAddModal = true">Add</v-btn>
          </div>
          
          <v-list bg-color="transparent" density="compact" class="pa-0">
            <v-list-item
              v-for="(section, index) in editorStore.draftConfig.sections"
              :key="section.id"
              :title="section.id.split('_')[0]"
              :subtitle="section.id"
              @click="activeSectionId = section.id"
              class="mb-3 rounded-xl custom-card drag-item"
              :class="{ 'is-dragging': draggedIndex === index }"
              draggable="true"
              @dragstart="onDragStart(index)"
              @dragover="onDragOver($event, index)"
              @dragend="onDragEnd"
              >
              <template v-slot:prepend>
                <v-icon class="drag-handle me-2" size="small">mdi-drag-vertical</v-icon>
              </template>
              <template v-slot:append>
                <v-btn icon="mdi-delete" variant="text" size="x-small" color="error" @click.stop="handleRemoveSection(section.id)" />
                <v-icon size="small" class="opacity-40 ms-2">mdi-chevron-right</v-icon>
              </template>
            </v-list-item>
          </v-list>
        </div>

        <!-- Active Section Editor -->
        <div v-else class="flex-grow-1 overflow-y-auto">
          <div class="d-flex align-center mb-6">
            <v-btn icon="mdi-arrow-left" variant="text" size="small" @click="closeSection" class="me-2" />
            <h2 class="text-subtitle-1 font-weight-bold">{{ activeBlueprintSection?.label || activeSection.type }}</h2>
          </div>

          <v-tabs v-model="tab" color="primary" align-tabs="start" class="mb-6 border-b border-white/10">
            <v-tab value="content" class="text-none">Content</v-tab>
            <v-tab value="style" class="text-none">Style</v-tab>
          </v-tabs>

          <v-window v-model="tab">
            <v-window-item value="content">
              <div v-for="field in activeBlueprintSection?.fields" :key="field.key" class="mb-6">
                <label class="d-block text-caption font-weight-bold text-uppercase tracking-widest opacity-50 mb-2">{{ field.label }}</label>
                
                <v-text-field
                  v-if="field.type === 'text'"
                  v-model="activeSection.fields[field.key]"
                  variant="outlined"
                  density="comfortable"
                  hide-details
                  class="rounded-lg"
                />
                
                <v-textarea
                  v-else-if="field.type === 'textarea'"
                  v-model="activeSection.fields[field.key]"
                  variant="outlined"
                  density="comfortable"
                  hide-details
                  auto-grow
                />

                <MediaPicker
                  v-else-if="field.type === 'image'"
                  v-model="activeSection.fields[field.key]"
                  :label="field.label"
                  :tenant-id="editorStore.website.tenant_id"
                />

                <div v-else-if="field.type === 'repeater'" class="bg-white/5 pa-4 rounded-xl">
                    <p class="text-caption font-italic opacity-60">Repeater fields coming soon...</p>
                </div>
              </div>
            </v-window-item>

            <v-window-item value="style">
               <div v-for="style in activeBlueprintSection?.styles" :key="style.key" class="mb-6">
                <label class="d-block text-caption font-weight-bold text-uppercase tracking-widest opacity-50 mb-2">{{ style.label }}</label>
                <v-color-picker
                  v-if="style.type === 'color'"
                  v-model="activeSection.styles[style.key]"
                  hide-canvas
                  hide-inputs
                  show-swatches
                  width="100%"
                  class="bg-transparent"
                />
              </div>
            </v-window-item>
          </v-window>
        </div>
      </template>

      <!-- Theme Menu -->
      <template v-else-if="layoutStore.activeMenu === 'theme'">
        <div class="flex-grow-1">
          <p class="opacity-60">Global theme settings will appear here.</p>
        </div>
      </template>

      <!-- Pages Menu -->
      <template v-else-if="layoutStore.activeMenu === 'pages'">
        <div class="flex-grow-1">
           <v-list bg-color="transparent">
             <v-list-item title="Home" prepend-icon="mdi-home" active color="primary" class="rounded-lg mb-2" />
             <v-list-item title="About" prepend-icon="mdi-information" class="rounded-lg mb-2" />
             <v-list-item title="Contact" prepend-icon="mdi-email" class="rounded-lg mb-2" />
           </v-list>
        </div>
      </template>

      <!-- Settings Menu -->
      <template v-else-if="layoutStore.activeMenu === 'settings'">
        <div class="flex-grow-1">
          <p class="opacity-60">General site settings.</p>
        </div>
      </template>

      <!-- Footer Actions -->
      <div class="pt-6 border-t border-white/10 d-flex flex-column" style="gap: 12px;">
        <v-btn
            block
            color="primary"
            variant="flat"
            rounded="xl"
            size="large"
            :loading="editorStore.isSaving"
            @click="editorStore.saveWebsite"
        >
          Save Changes
        </v-btn>
      </div>
    </div>

    <!-- Add Section Modal -->
    <v-dialog v-model="showAddModal" max-width="600">
      <v-card class="bg-grey-darken-4 text-white rounded-xl pa-6 overflow-hidden">
        <v-card-title class="font-outfit text-h5 mb-6">Add New Section</v-card-title>
        <v-row>
          <v-col v-for="s in editorStore.blueprint.schema.sections" :key="s.type" cols="6">
            <v-card 
              @click="handleAddSection(s.type)"
              variant="outlined" 
              class="border-thin border-white-opacity-10 hover:border-primary hover:bg-primary pa-4 text-center cursor-pointer rounded-xl"
            >
              <v-icon size="large" class="mb-2 opacity-60">mdi-plus-box</v-icon>
              <div class="font-weight-bold">{{ s.label }}</div>
              <div class="text-caption opacity-50">{{ s.type }}</div>
            </v-card>
          </v-col>
        </v-row>
      </v-card>
    </v-dialog>
  </div>
</template>

<style scoped>
.custom-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.05);
  transition: all 0.2s ease;
}

.drag-item {
  cursor: grab;
}

.drag-item:active {
  cursor: grabbing;
}

.is-dragging {
  opacity: 0.4;
  background: rgba(99, 102, 241, 0.2);
  border: 1px dashed #6366f1;
}

.drag-handle {
  cursor: grab;
  opacity: 0.4;
}

.drag-handle:hover {
  opacity: 1;
}

.border-white-opacity-10 {
  border-color: rgba(255, 255, 255, 0.1) !important;
}

:deep(.v-field) {
  background: rgba(255, 255, 255, 0.05) !important;
  border-radius: 12px !important;
}

:deep(.v-tab) {
  text-transform: none !important;
  letter-spacing: normal !important;
  font-weight: 600 !important;
}
</style>
