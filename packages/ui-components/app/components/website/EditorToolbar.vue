<script setup lang="ts">
import { useLayoutStore } from '@/stores/layout'

const layoutStore = useLayoutStore()
</script>

<template>
  <div class="toolbar-container bg-grey-darken-4 rounded-pill px-6 py-3 d-flex align-center ga-6 elevation-12 border-sm border-white/10">
    <v-btn
      v-if="!layoutStore.isPreviewMode"
      icon="mdi-menu"
      variant="text"
      size="small"
      color="white"
      :active="layoutStore.sidebarState !== 'hidden'"
      @click="layoutStore.toggleSidebar()"
    />
    
    <div v-if="!layoutStore.isPreviewMode" class="divider" />
    
    <div class="d-flex align-center ga-2">
      <v-btn 
        icon="mdi-cellphone" 
        variant="text" 
        size="small" 
        :color="layoutStore.previewDevice === 'mobile' ? 'primary' : 'white'"
        @click="layoutStore.setDevice('mobile')" 
      />
      <v-btn 
        icon="mdi-tablet" 
        variant="text" 
        size="small" 
        :color="layoutStore.previewDevice === 'tablet' ? 'primary' : 'white'"
        @click="layoutStore.setDevice('tablet')" 
      />
      <v-btn 
        icon="mdi-monitor" 
        variant="text" 
        size="small" 
        :color="layoutStore.previewDevice === 'desktop' ? 'primary' : 'white'"
        @click="layoutStore.setDevice('desktop')" 
      />
    </div>

    <div class="divider" />

    <v-btn
      variant="flat"
      :color="layoutStore.isPreviewMode ? 'error' : 'primary'"
      size="small"
      rounded
      :prepend-icon="layoutStore.isPreviewMode ? 'mdi-eye-off' : 'mdi-eye'"
      @click="layoutStore.togglePreviewMode()"
    >
      {{ layoutStore.isPreviewMode ? 'Exit Preview' : 'Preview' }}
    </v-btn>
  </div>
</template>

<style scoped>
.toolbar-container {
  position: fixed;
  bottom: 32px;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(15, 23, 42, 0.8) !important;
  backdrop-filter: blur(12px);
  z-index: 50;
}

.divider {
  height: 24px;
  width: 1px;
  background-color: rgba(255, 255, 255, 0.2);
}
</style>
