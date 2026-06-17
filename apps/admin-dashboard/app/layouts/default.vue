<script setup lang="ts">
const {tenant} = storeToRefs(useTenantStore())
</script>

<template>
<VApp v-if="tenant">
  <NavNavigationDrawer />
  <VMain>
    <NuxtPage />
  </VMain>
</VApp>
</template>

<style scoped>

</style>