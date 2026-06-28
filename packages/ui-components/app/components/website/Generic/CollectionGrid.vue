<script setup lang="ts">
import { useEditorStore } from '@/stores/editor'

interface Props {
  sectionId: string
  fields: {
    title?: string
    dataSource: any
    mappings: any
  }
  styles?: any
}

const props = defineProps<Props>()

const editorStore = useEditorStore()
const websiteId = editorStore.website?.id || 1

const { items, loading, error } = useDynamicCollection(
  props.fields.dataSource,
  props.fields.mappings,
  websiteId
)

</script>

<template>
  <div 
    class="collection-grid-section py-20"
    :style="{ 
      backgroundColor: styles?.bg_color || '#ffffff',
      color: styles?.text_color || 'inherit'
    }"
  >
    <v-container>
      <div v-if="fields.title" class="d-flex align-end justify-space-between mb-12">
         <div>
           <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-2 d-block">
            Curated Collection
          </span>
           <h2 class="text-h3 font-weight-bold font-outfit">
             {{ fields.title }}
           </h2>
         </div>
         <v-btn variant="text" color="primary" class="text-none font-weight-bold" append-icon="mdi-arrow-right">
           View All Listings
         </v-btn>
      </div>

      <div v-if="loading" class="d-flex justify-center py-12">
        <v-progress-circular indeterminate color="primary" size="64" />
      </div>

      <div v-else-if="error" class="text-center py-12 text-error">
        {{ error }}
      </div>

      <v-row v-else>
        <v-col 
          v-for="item in items" 
          :key="item.id"
          cols="12" sm="6" md="4"
        >
          <GenericCollectionCard :item="item" :section-id="sectionId"/>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
