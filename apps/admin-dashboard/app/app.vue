<script setup lang="ts">
const tenant = useTenant()
const theme = useTheme()

// Apply the tenant colors to a runtime Vuetify custom theme name or override active styles
if (tenant.value) {
  // Create or modify a custom dynamic theme block
  theme.themes.value.dynamicTenant = {
    dark: tenant.value.theme.background === '#121212', // automated dark mode detection
    colors: {
      primary: tenant.value.theme.primary,
      secondary: tenant.value.theme.secondary,
      background: tenant.value.theme.background,
    }
  }

  // Set active global theme to our dynamic override
  theme.change('dynamicTenant')
}
</script>
<template>
  <div>
    <NuxtLayout/>
    <SnackbarNotifier/>
  </div>
</template>

<style>
a {
  text-decoration: none !important;
}

.v-btn {
  text-transform: capitalize;
}
</style>