<script setup lang="ts">
// import {useUtils} from "#imports";
//
// const {scrollTo} = useUtils()

defineEmits(['showCalendarDialog'])

// const facebookUrl = getEntityItem('Contact', 'broker_facebook_url')
// const linkedInUrl = getEntityItem('Contact', 'broker_linkedin_url')
// const instagramUrl = getEntityItem('Contact', 'broker_instagram_url')

function scheduleCall() {
  scrollTo('contact')
}


</script>

<template>
  <v-card flat>
    <v-row>
      <v-col cols="12" sm="4">
        <v-img src="https://picsum.photos/200/300" max-height="350" class="fill-height" cover></v-img>
      </v-col>
    </v-row>
<!--      <v-col cols="12" sm="8" class="pb-10" align-self="center">-->
<!--        <v-row class="text-center text-sm-start">-->
<!--          <v-col cols="12">-->
<!--            <h1 class="mb-2">{{ getEntityItem('Contact', 'broker_name') }}</h1>-->
<!--            <h4>RESIDENTIAL AND COMMERCIAL REAL ESTATE BROKER</h4>-->
<!--          </v-col>-->
<!--          <v-col cols="12" class="d-flex justify-center justify-sm-start">-->
<!--            <div class="d-sm-flex justify-center justify-sm-start">-->
<!--              <div class="d-flex justify-center justify-sm-start mr-sm-10">-->
<!--                <v-icon class="mr-2">mdi-phone</v-icon>-->
<!--                <p>OFFICE</p>-->
<!--              </div>-->
<!--              <div>{{ getEntityItem('Contact', 'broker_office_number') }}</div>-->
<!--            </div>-->
<!--          </v-col>-->
<!--          <v-col cols="12" class="d-flex justify-center justify-sm-start">-->
<!--            <div class="d-sm-flex justify-center justify-sm-start">-->
<!--              <div class="d-flex justify-center justify-sm-start mr-sm-10">-->
<!--                <v-icon class="mr-2">mdi-cellphone</v-icon>-->
<!--                <p>MOBILE</p>-->
<!--              </div>-->
<!--              <div>{{ getEntityItem('Contact', 'broker_mobile_number') }}</div>-->
<!--            </div>-->
<!--          </v-col>-->
<!--          <v-col cols="12" class="d-flex justify-center justify-sm-start">-->
<!--            <div class="d-sm-flex justify-center justify-sm-start">-->
<!--              <div class="d-flex justify-center justify-sm-start mr-sm-14">-->
<!--                <v-icon class="mr-2">mdi-email</v-icon>-->
<!--                <p>EMAIL</p>-->
<!--              </div>-->
<!--              <div>{{ getEntityItem('Contact', 'broker_email') }}</div>-->
<!--            </div>-->
<!--          </v-col>-->
<!--        </v-row>-->
<!--      </v-col>-->
<!--    </v-row>-->
<!--    <v-card class="bg-black" tile>-->
<!--      <v-card-text>-->
<!--        <v-row class="mt-1">-->
<!--          <v-col cols="12" sm="3" class="d-flex justify-center">-->
<!--            <div class="d-flex mt-2">-->
<!--              <h2 class="mr-2">Contact Me</h2>-->
<!--              <v-icon class="mt-1">mdi-calendar</v-icon>-->
<!--            </div>-->
<!--          </v-col>-->
<!--          <v-col cols="12" sm="3" class="d-flex justify-center justify-sm-space-between">-->
<!--            <v-btn-->
<!--                v-if="facebookUrl"-->
<!--                icon="mdi-facebook"-->
<!--                flat-->
<!--                color="transparent"-->
<!--                :href="facebookUrl"-->
<!--                target="_blank"-->
<!--            />-->
<!--            <v-btn-->
<!--                v-if="linkedInUrl"-->
<!--                icon="mdi-linkedin"-->
<!--                flat-->
<!--                color="transparent"-->
<!--                :href="linkedInUrl"-->
<!--                target="_blank"-->
<!--            />-->
<!--            <v-btn-->
<!--                v-if="instagramUrl"-->
<!--                icon="mdi-instagram"-->
<!--                flat-->
<!--                color="transparent"-->
<!--                :href="instagramUrl"-->
<!--                target="_blank"-->
<!--            />-->
<!--          </v-col>-->
<!--          <v-col cols="12" sm="6" class="d-flex justify-center justify-sm-end">-->
<!--            <v-btn class="mt-2 bg-deep-orange-darken-2" rounded @click="scheduleCall">-->
<!--              Schedule a call-->
<!--              <v-icon>mdi-calendar</v-icon>-->
<!--            </v-btn>-->
<!--          </v-col>-->
<!--        </v-row>-->
<!--      </v-card-text>-->
<!--    </v-card>-->
  </v-card>
</template>

<style scoped>

</style>
