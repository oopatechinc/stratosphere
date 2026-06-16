<script setup lang="ts">
import { useEditorStore } from '@/stores/editor'

const props = defineProps<{
  section: any
}>()

const editorStore = useEditorStore()

// Resolve vertical-specific component
const componentName = computed(() => {
  if (props.section.type) return props.section.type
  
  // Fallback: Find type in blueprint schema by ID
  const blueprintSection = editorStore.blueprint?.schema?.sections?.find((s: any) => s.id === props.section.id)
  return blueprintSection?.type || props.section.id
})

// Component mapping for RealEstate vertical
const componentMap: Record<string, any> = {
  'RealEstateAppBar': resolveComponent('RealEstateAppBar'),
  'RealEstateHeader': resolveComponent('RealEstateHeader'),
  'RealEstateAboutMe': resolveComponent('RealEstateAboutMe'),
  'RealEstateProperties': resolveComponent('RealEstateProperties'),
  'RealEstateTestimonials': resolveComponent('RealEstateTestimonials'),
  'RealEstateContactMe': resolveComponent('RealEstateContactMe'),
  'RealEstateActionCards': resolveComponent('RealEstateActionCards'),
  'RealEstateDreamHome': resolveComponent('RealEstateDreamHome'),
  'RealEstateHeroCard': resolveComponent('RealEstateHeroCard'),
  'RealEstateNeighbourhoods': resolveComponent('RealEstateNeighbourhoods'),
  'CollectionGrid': resolveComponent('GenericCollectionGrid'),
}

const component = computed(() => {
  const name = componentName.value
  return componentMap[name] || null
})
</script>

<template>
  <div v-if="component" :id="section.id" class="editor-section-wrapper">
    <component 
      :is="component" 
      :section-id="section.id"
      :fields="section.fields"
      :styles="section.styles"
    />
  </div>
  <div v-else class="pa-8 border-md border-dashed border-error rounded text-error text-center">
    Unknown section type: {{ componentName }}
  </div>
</template>

<style scoped>
.editor-section-wrapper {
  position: relative;
  transition: all 0.3s ease;
}

:deep(.section-highlight) {
  outline: 4px solid #6366f1;
  outline-offset: -4px;
  animation: pulse-highlight 2s infinite;
  z-index: 10;
}

@keyframes pulse-highlight {
  0% { outline-color: rgba(99, 102, 241, 0.8); }
  50% { outline-color: rgba(99, 102, 241, 0.4); }
  100% { outline-color: rgba(99, 102, 241, 0.8); }
}
</style>
