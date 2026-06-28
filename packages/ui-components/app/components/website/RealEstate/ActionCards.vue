<script setup lang="ts">
import type {BusinessThemeEntity} from "~/types/businessThemeEntity.type";

const {getGroupEntities, getEntityItemByEntityId} = useBusinessStore()

const entities = getGroupEntities('action_cards')
    ?.sort((a: BusinessThemeEntity, b: BusinessThemeEntity) => Number(a.order) - Number(b.order))
</script>

<template>
  <v-card flat class="py-10">
    <v-card max-width="1200" class="mx-auto" flat tile color="transparent">
      <v-card-text>
        <v-row class="d-flex justify-center">
          <v-col
              v-for="(entity, i) in entities"
              cols="12"
              md="4"
              class="d-flex justify-center"
              data-aos="slide-up"
              data-aos-easing="ease-in-out"
              :data-aos-offset="-200"
              :data-aos-delay="100 * i"
          >
            <v-card flat>
              <v-img
                  :src="getEntityItemByEntityId(entity.id, 'image')"
                  height="400"
                  gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
                  cover
              >
                <div class="d-flex flex-column justify-center h-100">
                  <v-card-title>
                    <p class="text-white px-2 text-wrap text-center">
                      {{getEntityItemByEntityId(entity.id, 'action_card_text')}}
                    </p>
                  </v-card-title>
                  <v-card-actions class="justify-center">
                    <v-btn class="bg-deep-orange" elevation="2" width="150">{{getEntityItemByEntityId(entity.id, 'action_card_button_text')}}</v-btn>
                  </v-card-actions>
                </div>
              </v-img>
            </v-card>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-card>
</template>

<style scoped>
.about-me-text {
  font: 1.5rem solid
}
</style>