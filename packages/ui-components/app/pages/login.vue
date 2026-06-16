<script setup lang="ts">
const email = ref('demo@example.com')
const password = ref('password')
const loading = ref(false)
const error = ref('')

const { login } = useSanctumAuth()

async function handleLogin() {
  loading.value = true
  error.value = ''
  try {
    await login({
      email: email.value,
      password: password.value,
      device_name: 'webapp'
    })
    // Redirect is handled by nuxt-auth-sanctum config
  } catch (e: any) {
    error.value = 'Invalid credentials. Please try again.'
    console.error('Login failed', e)
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <v-container fluid class="fill-height bg-grey-darken-4 pa-6">
    <v-row align="center" justify="center" class="fill-height">
      <v-col cols="12" sm="8" md="6" lg="4" style="max-width: 448px">
        <v-card class="bg-grey-darken-3 text-white rounded-xl pa-8 border-thin border-white-opacity-10 elevation-12">
          <div class="text-center mb-8">
            <h1 class="text-h4 font-weight-bold font-outfit mb-2">Welcome Back</h1>
            <p class="text-grey-lighten-1">Sign in to manage your websites</p>
          </div>

          <v-alert v-if="error" type="error" variant="tonal" class="mb-6 rounded-lg" density="compact">
            {{ error }}
          </v-alert>

          <form @submit.prevent="handleLogin">
            <div class="mb-6">
              <label class="d-block text-caption font-weight-bold text-uppercase opacity-50 mb-2">Email Address</label>
              <v-text-field
                v-model="email"
                variant="outlined"
                density="comfortable"
                hide-details
                prepend-inner-icon="mdi-email-outline"
                class="rounded-lg"
              />
            </div>

            <div class="mb-6">
              <label class="d-block text-caption font-weight-bold text-uppercase opacity-50 mb-2">Password</label>
              <v-text-field
                v-model="password"
                type="password"
                variant="outlined"
                density="comfortable"
                hide-details
                prepend-inner-icon="mdi-lock-outline"
                class="rounded-lg"
              />
            </div>

            <v-btn
              type="submit"
              block
              color="primary"
              size="x-large"
              rounded="xl"
              class="font-outfit mt-4"
              :loading="loading"
            >
              Sign In
            </v-btn>
          </form>

          <div class="mt-8 text-center text-body-2 text-grey-darken-1">
            Don't have an account? <a href="#" class="text-primary font-weight-bold">Get started</a>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.border-white-opacity-10 {
  border-color: rgba(255, 255, 255, 0.1) !important;
}
:deep(.v-field) {
  background: rgba(255, 255, 255, 0.05) !important;
  border-radius: 16px !important;
}
</style>
