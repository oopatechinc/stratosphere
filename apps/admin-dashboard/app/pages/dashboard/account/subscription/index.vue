<script setup lang="ts">
const localePath = useLocalePath()
const {tenant} = storeToRefs(useTenantStore())

const hasExistingSubscription = computed(() => {
  return tenant.value?.subscription?.payment_status === 'paid'
})

</script>

<template>
  <div v-if="tenant" class="container pa-2">
    <VCard v-if="!hasExistingSubscription">
      <VCardText class="d-flex justify-center">
        <div class="text-center">
          <VIcon size="60">mdi-folder-outline</VIcon>
          <h3 class="mt-3 mb-2"> {{$t('app.dictionary.subscriptions')}} </h3>
          <p class="mb-2">{{$t('app.subscription.explanation')}}</p>
          <VBtn color="primary" :to="localePath('/dashboard/account/subscription/new')">{{$t('app.subscription.action_btn')}}</VBtn>
        </div>
      </VCardText>
    </VCard>
    <VCard v-else class="mt-10">
      <AccountExistingSubscription />
    </VCard>
  </div>
</template>