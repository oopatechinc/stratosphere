<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()
</script>

<template>
  <div 
    class="neighbourhoods-section py-20"
    :style="{ 
      backgroundColor: styles?.bg_color || 'black',
      color: styles?.text_color || 'white'
    }"
  >
    <v-container class="px-md-12">
      <div class="text-center mb-16">
        <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-2 d-block">
          Explore the Areas
        </span>
        <h2 class="text-h3 font-weight-bold font-outfit">
          Neighbourhoods I Cover
        </h2>
      </div>

      <v-row>
        <v-col 
          v-for="(item, index) in fields?.items" 
          :key="index"
          cols="12" sm="6" md="3"
        >
          <v-card class="area-card rounded-0 elevation-0 bg-transparent overflow-hidden">
            <div class="image-wrapper position-relative overflow-hidden mb-4 aspect-4-5">
              <v-img 
                :src="item.image || 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" 
                cover 
                class="area-image transition-all fill-height" 
              />
              <div class="area-overlay position-absolute inset-0 d-flex flex-column align-center justify-end pa-8">
                <div class="text-center z-index-2 w-100">
                  <h3 class="text-h5 font-weight-bold font-outfit mb-2 text-white">{{ item.name }}</h3>
                  <div class="divider mx-auto bg-primary mb-4" />
                  <p class="text-caption text-uppercase tracking-widest opacity-0 area-subtitle transition-all">
                    {{ item.count || '24' }} Active Listings
                  </p>
                </div>
                <div class="overlay-bg position-absolute inset-0 bg-gradient-to-t transition-all" />
              </div>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <div class="mt-16 text-center">
        <v-btn variant="outlined" color="primary" rounded="0" size="large" class="px-12 text-none">
          View All Neighbourhoods
        </v-btn>
      </div>
    </v-container>
  </div>
</template>

<style scoped>
.aspect-4-5 {
  aspect-ratio: 4 / 5;
}

.area-card:hover .area-image {
  transform: scale(1.15);
}

.area-card:hover .area-subtitle {
  opacity: 1;
  transform: translateY(0);
}

.area-subtitle {
  transform: translateY(10px);
}

.divider {
  width: 40px;
  height: 2px;
  transition: width 0.3s ease;
}

.area-card:hover .divider {
  width: 80px;
}

.overlay-bg {
  background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
  z-index: 1;
}

.area-card:hover .overlay-bg {
  background: linear-gradient(to top, rgba(245, 158, 11, 0.4) 0%, rgba(0,0,0,0.6) 100%);
}

.z-index-2 {
  z-index: 2;
}

.inset-0 {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.transition-all {
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
