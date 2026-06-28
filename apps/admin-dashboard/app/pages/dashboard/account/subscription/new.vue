<script setup lang="ts">
import {useSanctumClient} from "#imports";

const localePath = useLocalePath()
const client = useSanctumClient()
const config = useRuntimeConfig()

const tab = ref('select_plan')
const subscribe = ref(false)

const clientSecret = ref('')

async function handleSubscribe(plan: string) {
  clientSecret.value = await client('stripe/create-checkout-session',
      {method: 'POST', body: {plan}}
  )

  tab.value = 'payment_method'
}

function handlePayFacError(error)
{
  console.log({error})
  subscribe.value = false
}

</script>

<template>
<VDialog :model-value="true" fullscreen scrollable>
  <VCard>
    <VCardTitle class="d-flex justify-space-between">
      <VBtn icon flat :to="localePath('/dashboard/account/subscription')">
        <VIcon>mdi-close</VIcon>
      </VBtn>
      <VTabs v-model="tab" color="primary" align-tabs="center">
        <VTab value="select_plan">Select Plan</VTab>
        <VTab value="payment_method">Payment Method</VTab>
      </VTabs>
      <VBtn
          flat
          variant="outlined"
          rounded prepend-icon="mdi-cloud"
          @click="subscribe=true"
      >
        {{ $t('app.dictionary.subscribe') }}
      </VBtn>
    </VCardTitle>

    <VCardText>
      <VDivider />
      <VTabsWindow v-model="tab">
        <VTabsWindowItem value="select_plan">
          <VCard>
            <VCardText>
              <SubscriptionPlans
                  :subscribe-text="$t('app.subscription.action_btn')"
                  @subscribe="handleSubscribe"
              />
            </VCardText>
          </VCard>
        </VTabsWindowItem>
        <VTabsWindowItem value="payment_method">
         <VCard max-width="600" flat class="mx-auto">
           <VCardText>
             <StripeCheckout
                 :client-secret="clientSecret"
                 :stripe-pub-key="config.public.stripePublishableKey"
                 :subscribe="subscribe"
                 :show-submit-btn="false"
                 @error-occurred="handlePayFacError($event)"
                 @subscribing="subscribe=false"
             />
           </VCardText>
         </VCard>
        </VTabsWindowItem>
      </VTabsWindow>
    </VCardText>
  </VCard>

</VDialog>
</template>

<style scoped>

.title-text-2 {
  font-size: 2.5rem;
  font-weight: bold;
}
</style>