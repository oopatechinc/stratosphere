<script setup lang="ts">

import {useTenantWebsiteStore} from "#imports";

const {websites} = storeToRefs(useTenantWebsiteStore())
const {fetch} = useTenantWebsiteStore()
await fetch()

console.log({websites})
</script>

<template>

  <div>
    <SiteExistingWebsiteView v-if="websites.length"/>
    <SiteCreateNewWebsite v-else/>

  </div>

</template>

<style scoped>

</style>