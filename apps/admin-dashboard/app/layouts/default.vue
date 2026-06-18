<script setup lang="ts">
import type {User} from "@stratosphere/core-layer/types";
const user = useSanctumUser<User>()
</script>

<template>
<VApp v-if="user?.tenant_id">
  <NavNavigationDrawer />
  <VMain>
    <NuxtPage />
  </VMain>
</VApp>
</template>

<style scoped>

</style>