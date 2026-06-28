<script setup lang="ts">
import { useDisplay } from 'vuetify/framework'
import { useI18n } from '#imports'
import type {PlanInterface} from "~/components/subscription/pricing/Plans.vue";

const display = useDisplay()
const { tm, rt } = useI18n()

const tenant = useTenant()
const tenantNamespace = tenant.value.id

const plans = tm(`${tenantNamespace}.pricing.plans.items`) as Array<PlanInterface>

const features = tm(`${tenantNamespace}.pricing.features.items`) as Array<{
  type: string
  name: string
  description: string
  solo?: boolean
  team?: boolean
}>

</script>

<template>
  <VTable class="bg-transparent">
    <thead>
      <tr>
        <th class="text-left pb-10">
          <h3>{{ $t(`${tenantNamespace}.pricing.features.plans`) }}</h3>
        </th>
        <th v-for="plan in plans" class="text-left pb-10">
          <h3>{{ $rt(plan.name) }}</h3>
          <span>{{$rt(plan.price)}}/{{ $t('app.dictionary.month') }}</span>
        </th>
      </tr>
    </thead>
    <tbody>
      <template
        v-for="(feature, i) in features"
        :key="i"
      >
        <tr v-if="$rt(feature.type) === 'header'">
          <td colspan="4">
            <h3>{{ $rt(feature.name) }}</h3>
          </td>
        </tr>
        <tr v-else>
          <td>
            {{ $rt(feature.name) }}
            <VTooltip
              v-if="display.mdAndUp.value"
              :text="$rt(feature.description)"
              location="bottom"
            >
              <template #activator="{ props }">
                <v-icon
                  color="primary"
                  v-bind="props"
                >
                  mdi-information
                </v-icon>
              </template>
            </VTooltip>
          </td>
          <td><VIcon>{{ feature.starter ? 'mdi-check' : 'mdi-cancel' }}</VIcon></td>
          <td><VIcon>{{ feature.growth ? 'mdi-check' : 'mdi-cancel' }}</VIcon></td>
          <td><VIcon>{{ feature.pro_team ? 'mdi-check' : 'mdi-cancel' }}</VIcon></td>
        </tr>
      </template>
    </tbody>
  </VTable>
</template>

<style scoped>

</style>
