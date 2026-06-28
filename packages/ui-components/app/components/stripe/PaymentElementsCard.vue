<script setup lang="ts">
import type { StripeElements, StripeElementsOptionsClientSecret } from '@stripe/stripe-js'
import { loadStripe } from '@stripe/stripe-js/pure'
import { onMounted, watch, ref } from '#imports'

interface Props {
  stripePubKey: string
  clientSecret: string
  returnUrl: string
  submitted?: boolean
  info?: string
  showTitle?: boolean
  showSubmitBtn?: boolean
}

const props = defineProps<Props>()
const stripe = await loadStripe(props.stripePubKey)
let elements: StripeElements
const isLoading = ref(false)

onMounted(() => {
  const options = {
    clientSecret: props.clientSecret,
    // Fully customizable with appearance API.
    appearance: {
      base: {
        'color': '#32325d',
        'fontFamily': '"Helvetica Neue", Helvetica, sans-serif',
        'fontSmoothing': 'antialiased',
        'fontSize': '16px',
        '::placeholder': {
          color: '#aab7c4',
        },
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a',
      },
    },
  } as StripeElementsOptionsClientSecret

  // Create an instance of Elements.
  elements = stripe!.elements(options)

  // Create an instance of the card Element.
  const paymentElement = elements.create('payment')

  // Add an instance of the card Element into the `card-element` <div>.
  paymentElement.mount('#payment-element')
})

watch(() => props.submitted, (isSubmitted) => {
  if (isSubmitted) {
    confirmPayment()
  }
})

async function confirmPayment() {
  // set the redirect url
  isLoading.value = true
  await stripe!.confirmSetup({
    elements,
    confirmParams: {
      return_url: props.returnUrl,
    },
  })

  isLoading.value = false
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
/**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
.StripeElement {
  box-sizing: border-box;

  /*height: 80px;*/

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
