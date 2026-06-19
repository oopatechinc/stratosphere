<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()
</script>

<template>
  <div 
    class="about-section py-20 overflow-hidden"
    :style="{ 
      backgroundColor: styles?.bg_color || 'black',
      color: styles?.text_color || 'white'
    }"
  >
    <v-container class="px-md-12">
      <v-row align="center" class="ga-12">
        <v-col cols="12" md="5">
          <div class="image-stack position-relative">
            <v-img
              src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/user/Keniel.png"
              height="600"
              cover
              class="main-image rounded-0"
            />
            <div class="accent-box border-4 border-amber position-absolute" />
          </div>
        </v-col>
        
        <v-col cols="12" md="6">
          <div class="about-content ps-md-10">
            <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-4 d-block">
              Dedicated to Excellence
            </span>
            <h2 class="text-h2 font-weight-bold font-outfit mb-8 leading-tight">
              A Personal Approach to <span class="text-primary">Luxury Real Estate</span>
            </h2>
            <div class="bio-text opacity-80 mb-10">
              <p class="text-h6 font-weight-light mb-6">
                {{ fields?.text || 'With over a decade of experience in the luxury market, I provide my clients with unparalleled expertise and a personalized service that goes beyond the transaction.' }}
              </p>
              <p class="text-body-1">
                My mission is to help you find not just a house, but a home that reflects your lifestyle and aspirations. Whether you are buying your first home or selling a multi-million dollar estate, I am committed to achieving the best possible outcome for you.
              </p>
            </div>
            
            <div class="stats-row d-flex ga-12 mb-10">
              <div class="stat">
                <div class="text-h4 font-weight-bold text-primary">15+</div>
                <div class="text-caption text-uppercase tracking-widest opacity-50">Years Experience</div>
              </div>
              <div class="stat">
                <div class="text-h4 font-weight-bold text-primary">$500M+</div>
                <div class="text-caption text-uppercase tracking-widest opacity-50">Total Sales</div>
              </div>
              <div class="stat">
                <div class="text-h4 font-weight-bold text-primary">100%</div>
                <div class="text-caption text-uppercase tracking-widest opacity-50">Client Satisfaction</div>
              </div>
            </div>

            <v-btn variant="outlined" color="primary" rounded="0" size="large" class="px-10 text-none">
              Learn More About Me
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.image-stack {
  z-index: 1;
}

.accent-box {
  width: 100%;
  height: 100%;
  top: 40px;
  left: -40px;
  z-index: -1;
}

.leading-tight {
  line-height: 1.1;
}

.bio-text p {
  line-height: 1.8;
}
</style>
