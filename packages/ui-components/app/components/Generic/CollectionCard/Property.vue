<script setup lang="ts">
interface Props {
  item: object,
}
const props = defineProps<Props>()
</script>

<template>
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
        <h3 class="text-h6 font-weight-bold font-outfit leading-tight">{{ props.item.name }}</h3>
        <span class="text-primary font-weight-black text-h6">{{ props.item.price }}</span>
      </div>
      <p class="text-body-2 opacity-60 mb-4">
        {{props.item.beds}} Beds • {{props.item.baths}} Baths • 2,400 sqft
      </p>
      <div class="d-flex ga-4 opacity-40">
        <v-icon size="small">mdi-map-marker</v-icon>
        <span class="text-caption">Beverly Hills, CA</span>
      </div>
    </div>
  </v-card>
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