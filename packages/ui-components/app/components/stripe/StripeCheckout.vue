<script setup lang="ts">
import { loadStripe } from '@stripe/stripe-js/pure'
import {onMounted, watch, ref, useI18n} from '#imports'
import type { StripeCheckoutElementsSdk } from '@stripe/stripe-js'

interface Props {
  stripePubKey: string
  clientSecret: string
  subscribe?: boolean
  info?: string
  showTitle?: boolean
  showSubmitBtn?: boolean
}

const { t } = useI18n()
const props = defineProps<Props>()
const stripe = await loadStripe(props.stripePubKey, { locale: 'auto' })

const checkout = ref()
const paymentElement = ref()
const loadActionsResult = ref()
const isLoading = ref(false)

const emit = defineEmits(['errorOccurred', 'subscribing'])

watch(() => props.subscribe, (subscribeClicked) => {
  if (subscribeClicked) {
    confirmPayment()
    emit('subscribing')
  }
})

onMounted(async () => {
  initCheckout()
})

async function initCheckout() {
  checkout.value = stripe!.initCheckoutElementsSdk({
    clientSecret: props.clientSecret,
    elementsOptions: {
      appearance: {
        theme: 'stripe',
      },
    },
  }) as StripeCheckoutElementsSdk

  loadActionsResult.value = await checkout.value.loadActions();

  if (loadActionsResult.value.type === 'success') {
    paymentElement.value = checkout.value.createPaymentElement()
    paymentElement.value.mount('#payment-element')
  }
}

async function confirmPayment() {
  // set the redirect url
  isLoading.value = true
  let error = false
  loadActionsResult.value.actions.confirm().catch(() => {
    error = true
  })

  isLoading.value = false

  if (error) {
    emit('errorOccurred', t('shared_components_module.stripe.notifications.error'))
  }
}
</script>

<template>
  <VCard>
    <VCardTitle
      v-if="showTitle"
      class="primary d-flex justify-space-between white--text mb-5"
    >
      {{ $t('shared_components_module.stripe.title') }}
    </VCardTitle>

    <VCardSubtitle
      v-if="props.info"
      class="my-5"
    >
      <VIcon color="primary">
        mdi-information
      </VIcon>
      <i>{{ props.info }}</i>
    </VCardSubtitle>

    <VCardText>
      <div id="payment-element">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display form errors. -->
      <div
        id="error-message"
        role="alert"
      />
    </VCardText>
    <VCardActions v-if="showSubmitBtn">
      <VSpacer />
      <VBtn
        color="primary"
        :loading="isLoading"
        @click="confirmPayment"
      >
        {{ $t('shared_components_module.stripe.submit_btn') }}
      </VBtn>
    </VCardActions>
  </VCard>
</template>

<style scoped>

</style>
