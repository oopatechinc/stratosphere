<script setup lang="ts">
definePageMeta({
  middleware: 'verify-tenant'
})
</script>

<template>
<VCard flat color="transparent" class="fill-height">
  <VCardText>
    <VRow>
      <VCol cols="12" md="8">
        <DashboardLatestAppointments class="mb-2"/>
        <VCard>
          <VCardText class="my-2">
            <ChartsSalesChart />
          </VCardText>
        </VCard>
      </VCol>
      <VCol cols="12" md="4">
        <TrialExpirationCounter />
        <DashboardQuickActions class="mt-6"/>
      </VCol>
    </VRow>
  </VCardText>
</VCard>
</template>

<style scoped>

</style>