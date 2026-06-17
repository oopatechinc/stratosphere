<script setup lang="ts">
const config = useRuntimeConfig()
const plans = [
  {
    name: 'Solo',
    subtitle: 'For one-person businesses',
    price: 'CA$29.99',
    priceText: 'per month',
    text: '',
    features: [
      'Marketplace booking page',
      'Business Booking website',
      'Timezone-optimized bookings',
      'Sync appointment with calendars',
      'Connect Stripe for Payments',
      'Email & SMS notifications',
    ]
  },
  {
    name: 'Teams',
    subtitle: 'For growing teams',
    price: 'CA$19.99',
    priceText: 'per team member monthly',

    text: '',
    features: [
        'Staff Management',
        'Customized schedule for each staff',
        'New Staff Invitation',
        'Personalized calendar for each staff',
        'Ability for staff to use their own Stripe'
    ]
  },
  {
    name: 'Enterprise',
    subtitle: 'For large companies',
    price: 'Custom rates',
    caption: '',
    text: 'Enterprise solutions available for high-volume businesses with over 20 team members ',
    features: []
  },
]
</script>

<template>
<VRow>
  <VCol v-for="(plan, i) in plans" :key="i" cols="12" md="4" >
    <VCard class="rounded-lg d-flex flex-column" height="600">
      <VCardTitle>
        <h3>{{plan.name}}</h3>
        <p class="v-card-subtitle pl-0">{{plan.subtitle}}</p>

      </VCardTitle>
      <VCardTitle>
        <h2>{{plan.price}}</h2>
        <small class="pl-0">{{plan.priceText}}</small>

      </VCardTitle>
      <VCardText class="pl-0">
        <p v-if="plan.name === 'Teams'" class="pl-4  mt-3 v-card-subtitle">Everything in Solo, and:</p>

        <VList v-if="plan.features.length" :items="plan.features">
          <template #prepend>
            <div class="mr-2">
              <v-icon color="primary">mdi-check-circle</v-icon>
            </div>
          </template>
        </VList>
        <p v-else class="pl-5">{{plan.text}}</p>
      </VCardText>
      <VSpacer />
      <VCardActions>
        <NuxtLink :to="`${config.public.adminUrl}/signup`" class="w-100" target="_blank">
          <VBtn class="bg-primary my-3" elevation="1" block>Start Free Trial</VBtn>
        </NuxtLink>
      </VCardActions>
    </VCard>
  </VCol>
</VRow>
</template>

<style scoped>

</style>