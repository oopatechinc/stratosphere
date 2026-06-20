<script setup lang="ts">
import type {CollectionProperty} from "@stratosphere/core-layer/types";

const property = defineModel<CollectionProperty>()

const usdFormatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});

  async function handleDelete() {
  // let error = false
  // await BusinessService.deleteBusinessThemeEntity(this.entity.id).catch(() => {
  //   error = true
  // })
  //
  // if (error) {
  //   return useSnackbarStore().displayErrorMessage('Unable to delete property. Try again or contact support');
  // }
}

</script>

<template>
  <VCard class="wrapper rounded-lg" max-width="350">
    <div class="d-flex edit-icons">
      <VBtn icon color="primary" size="x-small" class="mr-2"><v-icon>mdi-pencil</v-icon></VBtn>
      <VBtn icon size="x-small" @click="handleDelete"><v-icon color="red">mdi-delete</v-icon></VBtn>
    </div>
    <VCarousel height="250" hide-delimiter-background>
      <VCarouselItem v-for="(item, i) in property?.images" :key="i" :src="item.url" cover/>
    </VCarousel>
    <VCard class="bg-primary" tile flat>
      <VCardText class="d-flex justify-center flex-column align-center">
        <h3>House for sale</h3>
      </VCardText>
    </VCard>
    <VCardText>
      <div class="d-flex">
        <VIcon size="30" class="mt-3" color="primary">mdi-map-marker</VIcon><h3>{{property?.content['address']}}</h3>
      </div>

      <div class="d-flex justify-space-between mt-8">
        <div><h3>{{usdFormatter.format(property?.content['price'])}}</h3></div>
        <div class="d-flex mt-4">
          <v-icon class="mr-1">mdi-bed</v-icon> {{property?.content['beds']}}
          <v-icon class="ml-4 mr-1">mdi-bathtub</v-icon> {{property?.content['beds']}}
        </div>
      </div>
    </VCardText>
  </VCard>
</template>

<style scoped>
.wrapper {
  position: relative;
}

.edit-icons {
  position: absolute;
  top: 5px;
  right: 10px;
  z-index: 100;
  background: #edf2f6;
  padding: 5px;
  border-radius: 5px;
}
</style>