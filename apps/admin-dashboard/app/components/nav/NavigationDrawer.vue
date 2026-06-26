<script setup lang="ts">

import type {User} from "@stratosphere/core-layer/types";

const localePath = useLocalePath()
const {logout} = useSanctumAuth()
const user = useSanctumUser<User>()
</script>

<template>
  <div>
    <VNavigationDrawer permanent>
      <template #prepend>
        <VBtn
            variant="outlined"
            class="ma-4"
            prepend-icon="mdi-account"
            append-icon="mdi-chevron-right"
            :text="user?.tenant?.name"
            :to="localePath('/dashboard/business/about')"
        />
      </template>

      <VDivider/>

      <NavNavigationDrawerRoutes />

      <template #append>
        <div class="pa-3">
          <LocaleSwitcher/>
          <VBtn color="primary" block @click="logout">{{$t('app.navigation_drawer.logout')}}</VBtn>
        </div>
      </template>
    </VNavigationDrawer>
  </div>

</template>

<style scoped>
a {
  color: black;
  text-decoration: none;
}
</style>