<script setup lang="ts">
import { useI18n } from "#imports";

interface Props {
  subscribeText: string
}

defineProps<Props>()

const tenant = useTenant()
const tenantNamespace = tenant.value.id

</script>

<template>
  <div>
    <div class="container">
      <div class="text-center">
        <div class="title-text-2">
          {{ $t(`${tenantNamespace}.pricing.title`) }}
        </div>
      </div>
    </div>

    <div class="section">
      <VCard
        max-width="1200"
        class="mx-auto"
        flat
        color="transparent"
      >
        <VCardText>
          <SubscriptionPricingPlans :subscribe-text="subscribeText" @subscribe="$emit('subscribe', $event)" />
        </VCardText>
      </VCard>
    </div>

    <div
      id="features"
      class="section"
    >
      <VCard
        max-width="1200"
        class="mx-auto"
        flat
        color="transparent"
      >
        <VCardText>
          <h3 class="title-text-2 mb-16">
            {{ $t('shared_components_module.pricing.features.title') }}
          </h3>
          <SubscriptionPricingFeaturesTable class="mb-10" />
        </VCardText>
      </VCard>
    </div>

    <div class="section">
      <VCard
        max-width="1200"
        class="mx-auto"
        flat
        color="transparent"
      >
        <FrequentlyAskedQuestions />
      </VCard>
    </div>
  </div>
</template>

<style scoped>
.title-text-2 {
  font-size: 2.5rem;
  font-weight: bold;
}
.container {
  max-width: 900px;
  text-align: center;
  margin: 16px auto 50px auto;
}

.section {
  padding: 40px 0;
}

#features {
  background-color: #FFFFFF;
}
</style>
