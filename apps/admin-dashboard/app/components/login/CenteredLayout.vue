<script setup lang="ts">
defineProps({
  tenant: Object
})
</script>
<template>
  <div class="content-login">
    <VCard tile color="grey-lighten-3" class="d-flex flex-row align-center justify-space-between">
      <VCard flat tile class="image-login">
        <VImg src="/images/brokery-hub/real-estate-agent.jpg" height="100vh" cover/>
      </VCard>

      <VCard color="transparent" elevation="0" tile>
        <div class="d-flex justify-end px-4">
          <LocaleSwitcher />
        </div>

        <div class="d-flex flex-column align-center justify-center form-login">
          <VImg :src="tenant.logo" alt="logo" width="550" height="150" cover/>
          <slot />
        </div>
      </VCard>
    </VCard>
  </div>
</template>

<style scoped>
.content-login .v-card {
  height: 100vh;
  font-size: 14px;
}

.content-login .v-card .v-card {
  width: 50%;
}

@media only screen and (max-width: 850px) {

  .content-login .v-card .v-card {
    width: 100%;
  }

  .content-login .image-login {
    display: none;
  }

}

.content-login .v-card.form-login {
  height: auto;
}

.content-login .sign-in-text {
  font-size: 20px;
}

.content-login .form-login-container {
  width: 350px;
}

@media only screen and (max-width: 380px) {

  .content-login .form-login-container {
    width: 90%;
  }

}

.content-login .form-login-container img {
  width: 70%;
}

</style>