<script setup lang="ts">
import { ref, onMounted } from 'vue'
import TemplateCard from "~/components/TemplateCard.vue";

const step = ref(1)
const templates = ref<any[]>([])
const selectedTemplate = ref()
const selectedThemeId = ref<number | null>(null)
const domain = ref('')
const loading = ref(false)

const client = useSanctumClient()
const config = useRuntimeConfig()

onMounted(async () => {
  try {
    templates.value = await client<any[]>('/templates')
  } catch (error) {
    console.error('Failed to fetch blueprints', error)
  }
})

function getCommaSeparatedVerticals() {
  return selectedTemplate.value.verticals.map(v => v.name).join(', ')
}

async function handleComplete() {
  loading.value = true
  try {
    const website = await client<any>('/website-onboarding', {
      method: 'POST',
      body: {
        domain: domain.value,
        template_id: selectedTemplate.value.id,
        theme_id: selectedThemeId.value,
      }
    })
    navigateTo(`/dashboard/sites/editor/${website.id}`)
  } catch (error) {
    console.error('Onboarding failed', error)
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <v-card fluid class=" bg-amber-darken-2 text-white pa-6">
    <v-row justify="center" align="center" class="w-100">
      <v-col cols="12" style="max-width: 960px">
        <div class="text-center mb-12">
          <h1 class="text-h3 font-weight-bold font-outfit mb-4">Let's build your website Now</h1>
          <p class="text-grey-lighten-1">Step {{ step }} of 3</p>
        </div>

        <!-- Step 1: Select Vertical -->
        <div v-if="step === 1" class="text-center">
          <h2 class="text-h5 font-weight-medium mb-8">Choose a template</h2>
          <v-row>
            <v-col v-for="template in templates" :key="template.id" cols="12" sm="6" md="4">
              <TemplateCard
                  :template="template"
                  @click="selectedTemplate = template; step = 2"
              />
            </v-col>
          </v-row>
        </div>

        <!-- Step 2: Select Theme -->
        <div v-if="step === 2">
          <div class="d-flex align-center justify-space-between mb-8">
              <v-btn icon="mdi-arrow-left" variant="text" @click="step = 1" />
              <h2 class="text-h5 font-weight-medium">Choose a starting theme</h2>
              <div style="width: 40px"></div>
          </div>
          
          <v-row v-if="selectedTemplate">
            <v-col v-for="theme in selectedTemplate.blueprint.themes" :key="theme.id" cols="12" sm="6">
              <v-card
                @click="selectedThemeId = theme.id; step = 3"
                class="theme-card bg-grey-darken-3 border-thin border-white-opacity-10 hover:border-primary transition-all rounded-xl overflow-hidden cursor-pointer"
              >
                <div style="height: 192px" class="bg-grey-darken-4 d-flex align-center justify-center">
                  <v-icon size="64" style="opacity: 0.2">mdi-monitor-screenshot</v-icon>
                </div>
                <div class="pa-6">
                  <div class="text-h6 font-weight-bold">{{ theme.name }}</div>
                  <div class="text-grey-lighten-1 text-caption">Professional layout for {{getCommaSeparatedVerticals()}}</div>
                </div>
              </v-card>
            </v-col>
          </v-row>
        </div>

        <!-- Step 3: Name and Finish -->
        <div v-if="step === 3" class="mx-auto" style="max-width: 448px">
          <div class="d-flex align-center justify-space-between mb-8">
              <v-btn icon="mdi-arrow-left" variant="text" @click="step = 2" />
              <h2 class="text-h5 font-weight-medium">One last thing</h2>
              <div style="width: 40px"></div>
          </div>

          <div class="mb-6">
            <label class="d-block text-caption font-weight-bold text-uppercase opacity-50 mb-2">Website Name</label>
            <v-text-field
              v-model="domain"
              variant="outlined"
              density="comfortable"
              placeholder="e.g. My Amazing Business"
              class="rounded-lg"
              hide-details
            >
              <template #append-inner>
                <p>{{config.public.locationWebsiteSuffix}}</p>
              </template>
            </v-text-field>
          </div>

          <v-btn
            block
            color="primary"
            size="x-large"
            rounded="xl"
            class="font-outfit"
            :loading="loading"
            :disabled="!domain"
            @click="handleComplete"
          >
            Create My Website
          </v-btn>
        </div>
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>
.industry-card, .theme-card {
  height: 100%;
}
:deep(.v-field) {
  background: rgba(255, 255, 255, 0.05) !important;
  border-radius: 16px !important;
}
</style>
