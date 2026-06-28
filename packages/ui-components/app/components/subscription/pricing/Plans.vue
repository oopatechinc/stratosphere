<script setup lang="ts">
import { useI18n, useRuntimeConfig } from '#imports'

interface Props {
  subscribeText: string
}

defineProps<Props>()

defineEmits(['subscribe'])

const config = useRuntimeConfig()
const { tm } = useI18n()

const tenant = useTenant()
const tenantNamespace = tenant.value.id

export interface PlanInterface {
  key: string
  name: string
  subtitle: string
  price: string
  price_text: string
  text: string
  features: []
}

const plans = tm(`${tenantNamespace}.pricing.plans.items`) as Array<PlanInterface>
</script>

<template>
  <VRow>
    <VCol
      v-for="(plan, i) in plans"
      :key="i"
      cols="12"
      md="4"
    >
      <VCard
        class="rounded-lg d-flex flex-column"
        height="700"
      >
        <VCardTitle>
          <h3>{{ $rt(plan.name) }}</h3>
          <p class="v-card-subtitle pl-0">
            {{ $rt(plan.subtitle) }}
          </p>
        </VCardTitle>
        <VCardTitle>
          <h2>{{ $rt(plan.price) }}</h2>
          <small class="pl-0">{{ $rt(plan.price_text) }}</small>
        </VCardTitle>
        <VCardText class="pl-0">
          <p
            v-if="$rt(plan.name) === 'Growth'"
            class="pl-4  mt-3 v-card-subtitle"
          >
            {{ $t(`${tenantNamespace}.pricing.plans.teams_include_text`) }}
          </p>

          <VList>
            <VListItem
              v-for="(feature, fIndex) in plan.features"
              :key="fIndex"
              :title="$rt(feature)"
            >
              <template #prepend>
                <div class="mr-2">
                  <v-icon color="primary">
                    mdi-check-circle
                  </v-icon>
                </div>
              </template>
            </VListItem>
          </VList>
          <p
            class="pl-5"
          >
            {{ $rt(plan.text) }}
          </p>
        </VCardText>
        <VSpacer />
        <VCardActions>
          <VBtn
            class="bg-primary my-3"
            elevation="1"
            block
            :text="subscribeText"
            @click="$emit('subscribe', $rt(plan.key))"
          />
        </VCardActions>
      </VCard>
    </VCol>
  </VRow>
</template>
