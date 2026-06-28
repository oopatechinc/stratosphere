<script setup lang="ts">
import type {BusinessThemeEntityItem} from "~/types/businessThemeEntityItem.type";

const props = defineProps({
  entity: {
    type: Object,
    required: true
  },
  index: Number,
  cardAttributes: {
    type: Object,
    default: {
      class: "d-flex flex-column mx-auto",
    }
  }
})

function getItem(key: string) {
  return props?.entity.items.find((p: BusinessThemeEntityItem) => p.key === key)?.value
}

function getItems(key: string) {
  return props?.entity.items.filter((p: BusinessThemeEntityItem) => p.key === key)
}

function onCarouselNavClick(ev, props) {
  ev.preventDefault()
  props.onClick()
}
</script>

<template>
  <NuxtLink :to="`properties/${entity.id}`">
    <v-card
        max-width="300"
        height="380"
        class="d-flex flex-column"
        v-bind="cardAttributes"
    >
      <v-carousel height="200">
        <v-carousel-item
            v-for="image in getItems('image')"
            :src="image.value"
            cover
        />
        <template #next="{props}">
          <v-btn icon @click="onCarouselNavClick($event, props)">
            <v-icon>mdi-chevron-right</v-icon>
          </v-btn>
        </template>
        <template #prev="{props}">
          <v-btn icon @click="onCarouselNavClick($event, props)">
            <v-icon>mdi-chevron-left</v-icon>
          </v-btn>
        </template>
      </v-carousel>
      <v-card color="black" height="50" tile>
        <v-card-text>
          <h3 class="text-center text-capitalize">
            {{ getItem('property_type') }} <span class="text-lowercase"> {{ getItem('property_sale_type') }}</span>
          </h3>
        </v-card-text>
      </v-card>
      <v-card-text>
        <div class="d-flex flex-column justify-space-between fill-height">
          <span>{{ getItem('gmaps_full_address') }}</span>


          <div class="d-flex justify-space-between">
            <div><h3>{{ formatCurrency(getItem('price')) }}</h3></div>
            <div class="d-flex">
              <v-icon class="mr-1">mdi-bed</v-icon>
              {{ getItem('num_of_beds') }}
              <v-icon class="ml-4 mr-1">mdi-bathtub</v-icon>
              {{ getItem('num_of_baths') }}
            </div>
          </div>
        </div>
      </v-card-text>
    </v-card>
  </NuxtLink>
</template>

<style scoped>

</style>