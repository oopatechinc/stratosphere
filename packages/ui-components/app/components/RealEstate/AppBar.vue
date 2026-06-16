<script setup lang="ts">
const props = defineProps<{
  sectionId: string
  fields: any
  styles: any
}>()

const display = useDisplay()

function scrollToSection(id: string) {
  const element = document.getElementById(id)
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' })
  }
}

const navLinks = [
  { label: 'Home', id: 'hero' },
  { label: 'Properties', id: 'properties' },
  { label: 'Neighbourhoods', id: 'neighbourhoods' },
  { label: 'About Me', id: 'about_me' },
  { label: 'Contact', id: 'contact' },
]
</script>

<template>
  <v-app-bar
    :color="styles?.bg_color || 'black'"
    density="comfortable"
    flat
    class="border-b border-white/10"
  >
    <div class="container d-flex align-center w-100 px-4 px-md-12">
      <v-app-bar-title>
        <div class="d-flex align-center ga-2 cursor-pointer" @click="scrollToSection('hero')">
          <div class="logo-box bg-primary px-2 py-1 rounded text-white font-weight-black text-uppercase">
            JD
          </div>
          <span class="font-weight-bold text-h6 text-white tracking-widest font-outfit uppercase">Jane Doe</span>
        </div>
      </v-app-bar-title>

      <v-spacer />

      <template v-if="display.mdAndUp.value">
        <nav>
          <ul class="d-flex align-center ga-8 list-none">
            <li v-for="link in navLinks" :key="link.id">
              <a 
                href="javascript:void(0)" 
                class="nav-link" 
                @click="scrollToSection(link.id)"
              >
                {{ link.label }}
              </a>
            </li>
          </ul>
        </nav>
      </template>
      
      <v-btn
        v-if="display.smAndDown.value"
        icon="mdi-menu"
        color="white"
        variant="text"
      />
    </div>
  </v-app-bar>
</template>

<style scoped>
.nav-link {
  color: white;
  text-decoration: none;
  font-size: 0.875rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  opacity: 0.7;
  transition: opacity 0.2s;
}

.nav-link:hover {
  opacity: 1;
}

.logo-box {
  font-size: 1.2rem;
}

.cursor-pointer {
  cursor: pointer;
}
</style>
