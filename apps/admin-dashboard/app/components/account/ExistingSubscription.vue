<script setup lang="ts">
const {business} = storeToRefs(useBusinessStore())

const paymentMethods = [
  {
    platform: 'Stripe',
    icon: 'stripe.svg',
    card: {
      title: 'Stripe',
      description: 'A stripe card is here'
    }
  },
  {
    platform: 'Paypal',
    icon: 'stripe.svg',
    card: {
      title: 'Paypal',
      description: 'A paypal card is here'
    }
  }
]
</script>

<template>
  <VCard flat class="ma-4">
    <VCardTitle class="d-flex justify-space-between">
      <div>
        <span>{{$t('app.subscription.active_plan')}}</span>
      </div>
      <div>
        <VBtn variant="text" color="danger" :text="$t('app.subscription.cancel_plan')" />
      </div>
    </VCardTitle>
    <VCardText>
      <VDivider class="my-6"/>
      <VRow>
        <VCol>
          <div class="mb-2">
            <VChip class="text-capitalize" color="primary">
              {{business?.subscription?.plan?.name}}
            </VChip>
          </div>
          <NuxtLink to="#">
            <h4>({{$t('app.subscription.manage_plan')}}) </h4>
          </NuxtLink>
        </VCol>
        <VCol>
          <div class="text-left text-grey-darken-1 mb-5">{{$t('app.subscription.expiration_date')}}</div>
          <h4>{{$t('app.subscription.ongoing')}}</h4>
        </VCol>
        <VCol>
          <div  class="text-left text-grey-darken-1 mb-5">{{$t('app.subscription.payment_method')}}</div>
          <h4>CARD</h4>
        </VCol>
        <VCol class="d-flex flex-column justify-center">
          <h2>${{business?.subscription?.total}}/{{$t('app.dictionary.month')}}</h2>
        </VCol>
      </VRow>

<!--      <VDivider class="my-6" />-->
<!--      <h3>Payment Method</h3>-->

<!--      <VDivider class="my-6" />-->

<!--      <VRow>-->
<!--        <VCol v-for="(item, i) in paymentMethods" :key="i">-->
<!--          <AccountPaymentMethodCard :platform="item.platform" :icon="item.icon" :card="item.card"/>-->
<!--        </VCol>-->
<!--      </VRow>-->

    </VCardText>
  </VCard>
</template>

<style scoped>

</style>