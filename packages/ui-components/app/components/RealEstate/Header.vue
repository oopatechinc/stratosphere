<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()

const display = useDisplay()
</script>

<template>
  <div 
    class="hero-section position-relative overflow-hidden"
    :style="{ backgroundColor: styles?.bg_color || 'black' }"
  >
    <!-- Hero Image with Gradient Overlay -->
    <v-img
      :src="fields?.image_url || 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'"
      height="800"
      cover
      class="hero-image"
    >
      <div class="overlay d-flex align-center">
        <v-container class="px-md-12">
          <v-row>
            <v-col cols="12" md="8" lg="6">
              <div class="content-box">
                <span class="text-primary text-uppercase font-weight-bold tracking-widest mb-4 d-block animate-fade-in">
<!--                  Exclusive Luxury Estates-->
                  Exclusive Residential Buildings
                </span>
                <h1 class="hero-title text-white font-outfit mb-6 animate-slide-up">
                  Keniel St Louis
                </h1>
                <div class="subtitle-box border-s-4 border-primary ps-6 mb-10">
                  <p class="text-h5 text-white font-weight-light mb-2">
                    Residential and Commercial
                  </p>
                  <p class="text-h4 text-primary font-weight-black text-uppercase tracking-tighter">
                    Real Estate Broker
                  </p>
                </div>

                <div class="d-flex flex-wrap ga-6 mb-10">
                  <div class="contact-item">
                    <span class="text-caption text-uppercase opacity-50 d-block mb-1">Office</span>
                    <span class="text-white font-weight-bold">514.914.8365</span>
                  </div>
<!--                  <div class="contact-item">-->
<!--                    <span class="text-caption text-uppercase opacity-50 d-block mb-1">Mobile</span>-->
<!--                    <span class="text-white font-weight-bold">514.914.8365</span>-->
<!--                  </div>-->
                  <div class="contact-item">
                    <span class="text-caption text-uppercase opacity-50 d-block mb-1">Email</span>
                    <span class="text-white font-weight-bold">kenielstls6@gmail.com</span>
                  </div>
                </div>

                <div class="d-flex align-center ga-4">
                  <v-btn
                    color="primary"
                    size="x-large"
                    rounded="xl"
                    class="px-10 text-none font-weight-bold elevation-10"
                    prepend-icon="mdi-calendar-check"
                  >
                    Schedule a Call
                  </v-btn>
                  
                  <div class="social-icons d-flex ga-2">
                    <v-btn icon="mdi-facebook" variant="text" color="white" size="small" href="https://instagram.com/kenielstlouis" target="_blank"/>
<!--                    <v-btn icon="mdi-instagram" variant="text" color="white" size="small" />-->
<!--                    <v-btn icon="mdi-linkedin" variant="text" color="white" size="small" />-->
                  </div>
                </div>
              </div>
            </v-col>
          </v-row>
        </v-container>
      </div>
    </v-img>
    
    <!-- Floating Bottom Bar (Optional aesthetic touch from preview) -->
    <div class="hero-accent-bar position-absolute bottom-0 right-0 bg-primary w-25 h-1" />
  </div>
</template>

<style scoped>
.hero-section {
  min-height: 800px;
}

.hero-image {
  transform: scale(1.05);
  animation: slow-zoom 20s infinite alternate;
}

.overlay {
  height: 100%;
  background: linear-gradient(90deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0.2) 100%);
}

.hero-title {
  font-size: clamp(4rem, 10vw, 8rem);
  line-height: 0.9;
  letter-spacing: -0.05em;
  font-weight: 800;
  text-transform: uppercase;
}

.animate-fade-in {
  animation: fadeIn 1s ease-out forwards;
}

.animate-slide-up {
  animation: slideUp 1s cubic-bezier(0.2, 0, 0, 1) forwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

@keyframes slow-zoom {
  from { transform: scale(1); }
  to { transform: scale(1.1); }
}

.subtitle-box p {
  line-height: 1.2;
}

.contact-item {
  border-right: 1px solid rgba(255,255,255,0.1);
  padding-right: 1.5rem;
}

.contact-item:last-child {
  border-right: none;
}
</style>
