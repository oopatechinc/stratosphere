<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()
</script>

<template>
  <div 
    class="testimonials-section py-20 overflow-hidden"
    :style="{ 
      backgroundColor: styles?.bg_color || '#ffffff',
      color: styles?.text_color || 'inherit'
    }"
  >
    <v-container class="px-md-12">
      <div class="text-center mb-16">
        <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-2 d-block">
          Trusted by Many
        </span>
        <h2 class="text-h3 font-weight-bold font-outfit">
          What My Clients Say
        </h2>
      </div>
      
      <v-row>
        <v-col 
          v-for="(item, index) in fields?.items" 
          :key="index"
          cols="12" md="4"
        >
          <div class="testimonial-card h-100 d-flex flex-column pa-8 bg-grey-lighten-4 position-relative">
            <v-icon color="primary" size="64" class="position-absolute top-0 right-0 opacity-10 me-4 mt-4">
              mdi-format-quote-close
            </v-icon>
            
            <div class="rating d-flex ga-1 mb-6">
              <v-icon v-for="i in 5" :key="i" color="primary" size="x-small">mdi-star</v-icon>
            </div>
            
            <p class="text-h6 font-weight-light font-italic mb-10 flex-grow-1 opacity-80 leading-relaxed">
              "{{ item.quote || 'Jane is an exceptional professional. She guided us through the entire process with grace and expertise.' }}"
            </p>
            
            <div class="client d-flex align-center ga-4">
              <v-avatar color="primary" size="56" class="elevation-4">
                <span class="text-white font-weight-bold text-h6">{{ item.client_name?.[0] || 'C' }}</span>
              </v-avatar>
              <div>
                <div class="font-weight-black text-subtitle-1 leading-tight">{{ item.client_name || 'Anonymous Client' }}</div>
                <div class="text-caption text-uppercase tracking-widest opacity-50">Verified Homeowner</div>
              </div>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.testimonial-card {
  border-bottom: 4px solid transparent;
  transition: all 0.3s ease;
}

.testimonial-card:hover {
  background: white !important;
  box-shadow: 0 20px 40px rgba(0,0,0,0.05);
  border-bottom-color: #f59e0b;
}

.leading-relaxed {
  line-height: 1.6;
}

.leading-tight {
  line-height: 1.2;
}
</style>
