<script setup lang="ts">

</script>

<template>
  <div>
    <div class="container">
      <div class="text-center">
        <div class="title-text">Pick the right plan for your business</div>
      </div>
    </div>

    <div class="section">
      <VCard max-width="1200" class="mx-auto" flat color="transparent">
        <VCardText>
          <PricingPlans />
        </VCardText>
      </VCard>
    </div>

    <div id="features" class="section">
      <VCard max-width="1200" class="mx-auto" flat color="transparent">
        <VCardText>
          <h3 class="title-text-2 mb-16">Features</h3>
          <PricingFeaturesTable class="mb-10" />
        </VCardText>
      </VCard>
    </div>

    <div class="section">
      <VCard max-width="1200" class="mx-auto" flat color="transparent">
        <FAQ />
      </VCard>

    </div>

  </div>
</template>

<style scoped>
.container {
  text-align: center;
}

.section {
  padding: 30px 0;
}

#features {
  background-color: #FFFFFF;
}

.title-text {
  font-size: 2rem;
}
</style>