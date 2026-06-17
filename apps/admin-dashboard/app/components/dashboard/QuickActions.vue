<script setup lang="ts">
const localePath = useLocalePath()
const {t} = useI18n()
const actions = [
  {
    props: {
      title: t('app.dashboard.quick_actions.actions.1.title'),
      subtitle: t('app.dashboard.quick_actions.actions.1.subtitle'),
      prependIcon: "mdi-home-city",
      to: localePath("/dashboard/business/locations")
    },
  },
  {
    props: {
      title: t('app.dashboard.quick_actions.actions.2.title'),
      subtitle: t('app.dashboard.quick_actions.actions.2.subtitle'),
      prependIcon: "mdi-web",
      href: "https://google.com",
      target: '_blank'
    },
  },
]
</script>

<template>
  <VCard>
    <VCardTitle class="d-flex justify-space-between">
      <p>{{$t('app.dashboard.quick_actions.title')}}</p>
    </VCardTitle>
    <VCardText>
        <VList :items="actions" />
    </VCardText>
  </VCard>
</template>

<style scoped>

</style>