<script setup lang="ts">
  const snackbar = useSnackbarStore()
</script>

<template>
  <v-snackbar v-model="snackbar.display" location="top" :color="snackbar.color">
    {{snackbar.getMessage().value.replace(/['"]+/g, '')}}
    <template #actions>
      <v-btn
          :color="snackbar.color === 'success' ? 'pink' : 'amber'"
          variant="text"
          @click="snackbar.closeMessage"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<style scoped>

</style>