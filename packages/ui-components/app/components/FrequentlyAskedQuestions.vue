<script setup lang="ts">
import { useI18n } from '#imports'

const { tm } = useI18n()
const faqs = tm('shared_components_module.faq.items') as Array<{
  question: string
  answer: string
}>
</script>

<template>
  <div class="wrapper">
    <h3 class="title-text-2 my-16 text-center">
      {{ $t('shared_components_module.faq.title') }}
    </h3>
    <VCard
      max-width="1200"
      class="mx-auto mb-10"
      color="transparent"
      flat
    >
      <VCardText>
        <v-expansion-panels>
          <v-expansion-panel
            v-for="(faq, i) in faqs"
            :key="i"
            :text="$rt(faq.answer)"
            :title="$rt(faq.question)"
          />
        </v-expansion-panels>
      </VCardText>
    </VCard>
  </div>
</template>

<style scoped>
.wrapper {
  margin-top: 160px;
}
</style>
