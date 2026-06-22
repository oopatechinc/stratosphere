<script setup lang="ts">
defineProps({
  tenant: Object
})
</script>
<template>
  <div class="content-login">
    <VCard tile color="black" class="d-flex flex-row align-center justify-space-between">

      <VCard tile class="image-login">
        <VCarousel hide-delimiters :show-arrows="false" height="100vh" cycle continuous>
          <VCarouselItem src="/images/bookisia/carousel-image-1.jpg" height="100vh" cover/>
          <VCarouselItem src="/images/bookisia/carousel-image-2.jpg" height="100vh" cover/>
          <VCarouselItem src="/images/bookisia/carousel-image-3.jpg" height="100vh" cover/>
        </VCarousel>
      </VCard>

      <VCard color="transparent" elevation="0" tile>
        <div class="d-flex justify-end px-4">
          <LocaleSwitcher />
        </div>

        <div class="d-flex flex-column align-center justify-center form-login">
          <VImg :src="tenant.logo" alt="logo" width="300"/>
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

.content-login .form-login-container img {
  width: 70%;
}

</style>