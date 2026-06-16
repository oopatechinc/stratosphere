<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()
</script>

<template>
  <div 
    class="properties-section py-20"
    :style="{ 
      backgroundColor: styles?.bg_color || '#f5f5f5',
      color: styles?.text_color || 'inherit'
    }"
  >
    <v-container class="px-md-12">
      <div class="d-flex align-end justify-space-between mb-12">
        <div>
          <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-2 d-block">
            Curated Collection
          </span>
          <h2 class="text-h3 font-weight-bold font-outfit">
            {{ fields?.title || 'Featured Properties' }}
          </h2>
        </div>
        <v-btn variant="text" color="primary" class="text-none font-weight-bold" append-icon="mdi-arrow-right">
          View All Listings
        </v-btn>
      </div>
      
      <v-row>
        <v-col 
          v-for="(item, index) in fields?.items" 
          :key="index"
          cols="12" sm="6" md="4"
        >
          <v-card class="property-card rounded-0 elevation-0 bg-transparent overflow-hidden">
            <div class="image-wrapper position-relative overflow-hidden mb-4">
              <v-img :src="item.image" height="400" cover class="property-image transition-all" />
              <div class="status-badge position-absolute top-0 right-0 bg-black text-white px-4 py-1 text-caption font-weight-bold uppercase mt-4 me-4">
                For Sale
              </div>
              <div class="property-overlay position-absolute inset-0 d-flex align-center justify-center">
                <v-btn variant="flat" color="white" class="text-none font-weight-bold" rounded="0">View Details</v-btn>
              </div>
            </div>
            
            <div class="content">
              <div class="d-flex justify-space-between align-start mb-2">
                <h3 class="text-h6 font-weight-bold font-outfit leading-tight">{{ item.name }}</h3>
                <span class="text-primary font-weight-black text-h6">{{ item.price }}</span>
              </div>
              <p class="text-body-2 opacity-60 mb-4">
                3 Beds • 2 Baths • 2,400 sqft
              </p>
              <div class="d-flex ga-4 opacity-40">
                <v-icon size="small">mdi-map-marker</v-icon>
                <span class="text-caption">Beverly Hills, CA</span>
              </div>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.property-card {
  transition: transform 0.3s ease;
}

.image-wrapper {
  background: #eee;
}

.property-image {
  transition: transform 0.6s cubic-bezier(0.2, 0, 0, 1);
}

.property-card:hover .property-image {
  transform: scale(1.1);
}

.property-overlay {
  background: rgba(0,0,0,0.4);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.image-wrapper:hover .property-overlay {
  opacity: 1;
}

.inset-0 {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.leading-tight {
  line-height: 1.2;
}
</style>
