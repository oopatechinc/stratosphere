<script setup lang="ts">
import { ref } from "#imports"

const email = ref('')

const subscribe = () => {
  if (email.value) {
    // Handle your subscription logic here
    alert(`Success! We'll reach out to ${email.value} soon.`)
    email.value = ''
  }
}
</script>

<template>
  <VApp>
    <VMain class="wrapper bg-grey-lighten-4">
      <VContainer class="fill-height" fluid>
        <VRow align="center" justify="center">
          <VCol cols="12" sm="8" md="6" lg="4">
            <VCard class="pa-8 text-center elevation-12" rounded="xl">
              <VAvatar color="primary" size="80" class="mb-6 elevation-4">
                <VIcon icon="mdi-hammer-wrench" size="40" color="white" />
              </VAvatar>

              <h1 class="text-h3 font-weight-bold mb-2">Under Construction</h1>
              <p class="text-subtitle-1 text-medium-emphasis mb-8">
                We're fine-tuning the gears! Our new site is launching soon.
              </p>

              <div class="mb-8">
                <div class="d-flex justify-space-between mb-2">
                  <span class="text-caption font-weight-bold">Development Progress</span>
                  <span class="text-caption font-weight-bold">85%</span>
                </div>
                <VProgressLinear
                    model-value="85"
                    color="primary"
                    height="10"
                    rounded
                    striped
                />
              </div>

              <VForm @submit.prevent="subscribe">
                <VTextField
                    v-model="email"
                    label="Email Address"
                    placeholder="name@example.com"
                    variant="outlined"
                    prepend-inner-icon="mdi-email-outline"
                    class="mb-2"
                    hide-details
                />

                <VBtn
                    block
                    color="primary"
                    size="large"
                    type="submit"
                    elevation="2"
                    class="mt-4 font-weight-bold"
                    rounded="lg"
                >
                  Notify Me
                </VBtn>
              </VForm>

              <VDivider class="my-8" />
              <div class="d-flex justify-center gap-4">
                <v-btn icon="mdi-twitter" variant="text" color="blue-lighten-1"></v-btn>
                <v-btn icon="mdi-github" variant="text" color="grey-darken-3"></v-btn>
                <v-btn icon="mdi-linkedin" variant="text" color="blue-darken-2"></v-btn>
              </div>

            </VCard>

            <p class="text-center mt-6 text-grey-darken-1 text-caption">
              © 2026 Powered by Bookisia. All rights reserved.
            </p>

          </VCol>
        </VRow>
      </VContainer>
    </VMain>
  </VApp>
</template>

<style scoped>

.wrapper {
  background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url("/images/under-construction.jpg") no-repeat ;
  background-size: cover;
}
.gap-4 {
  gap: 16px;
}
</style>