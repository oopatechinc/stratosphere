<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()
</script>

<template>
  <div 
    class="contact-section py-20"
    :style="{ 
      backgroundColor: styles?.bg_color || '#212121',
      color: styles?.text_color || 'white'
    }"
  >
    <v-container class="px-md-12">
      <v-row class="ga-12">
        <v-col cols="12" md="5">
          <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-4 d-block">
            Get in Touch
          </span>
          <h2 class="text-h2 font-weight-bold font-outfit mb-8 leading-tight">
            Ready to find your <span class="text-primary">perfect home?</span>
          </h2>
          <p class="text-h6 font-weight-light opacity-70 mb-12">
            Contact me today for a private consultation and discover how I can help you achieve your real estate goals.
          </p>
          
          <div class="contact-info d-flex flex-column ga-8">
            <div class="d-flex align-center ga-4">
              <v-btn icon="mdi-phone" color="primary" variant="flat" rounded="circle" />
              <div>
                <div class="text-caption text-uppercase opacity-50">Call Me</div>
                <div class="text-h6 font-weight-bold">{{ fields?.phone || '514.914.8365' }}</div>
              </div>
            </div>
            
            <div class="d-flex align-center ga-4">
              <v-btn icon="mdi-email" color="primary" variant="flat" rounded="circle" />
              <div>
                <div class="text-caption text-uppercase opacity-50">Email Me</div>
                <div class="text-h6 font-weight-bold">{{ fields?.email || 'kenielstls6@gmail.com' }}</div>
              </div>
            </div>
            
            <div class="d-flex align-center ga-4">
              <v-btn icon="mdi-map-marker" color="primary" variant="flat" rounded="circle" />
              <div>
                <div class="text-caption text-uppercase opacity-50">Visit Office</div>
                <div class="text-h6 font-weight-bold">755 Boulevard St John, Point Claire, Quebec</div>
              </div>
            </div>
          </div>
        </v-col>
        
        <v-col cols="12" md="6">
          <v-card class="bg-white/5 border border-white/10 rounded-xl pa-8">
            <h3 class="text-h5 font-weight-bold mb-8">Send a Message</h3>
            <v-row>
              <v-col cols="12" sm="6">
                <v-text-field label="Full Name" variant="outlined" color="primary" hide-details class="mb-6" />
              </v-col>
              <v-col cols="12" sm="6">
                <v-text-field label="Email Address" variant="outlined" color="primary" hide-details class="mb-6" />
              </v-col>
              <v-col cols="12">
                <v-select label="Property Type" :items="['Residential', 'Commercial', 'Land']" variant="outlined" color="primary" hide-details class="mb-6" />
              </v-col>
              <v-col cols="12">
                <v-textarea label="Your Message" variant="outlined" color="primary" rows="4" hide-details class="mb-8" />
              </v-col>
            </v-row>
            <v-btn block color="primary" size="x-large" rounded="0" class="font-weight-bold text-none">
              Send Message
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    
    <div class="footer-bottom border-t border-white/10 mt-20 pt-10 pb-4">
      <v-container class="px-md-12">
        <div class="d-flex flex-wrap justify-space-between align-center ga-4">
          <div class="opacity-50 text-caption">
            © 2026 Keniel St Louis Real Estate. All rights reserved.
          </div>
          <div class="social-links d-flex ga-4">
            <a href="#" class="text-white opacity-50 hover-opacity-100 transition-all">Privacy Policy</a>
            <a href="#" class="text-white opacity-50 hover-opacity-100 transition-all">Terms of Service</a>
          </div>
        </div>
      </v-container>
    </div>
  </div>
</template>

<style scoped>
.leading-tight {
  line-height: 1.1;
}

.hover-opacity-100:hover {
  opacity: 1 !important;
}
</style>
