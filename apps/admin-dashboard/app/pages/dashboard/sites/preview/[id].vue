<script setup lang="ts">

</script>

<template>
<VDialog :model-value="true" fullscreen>
  <VBtn
      id="close-btn"
      icon="mdi-close"
      to="/dashboard/sites"
      color="primary"
      variant="outlined"
  />
  <WebsiteViewer source="admin" />
</VDialog>
</template>

<style scoped>
 #close-btn {
   position: fixed;
   top: 15px;
   right: 15px;
   z-index: 9999;
 }
</style>