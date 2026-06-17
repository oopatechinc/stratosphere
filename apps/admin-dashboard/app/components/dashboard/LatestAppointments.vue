<script setup lang="ts">

const router = useRouter()
const localePath = useLocalePath()
const appointments = ref([])



const currentAppointment = ref({})
const showAppointmentDialog = ref(false)
const loading = ref(false)






function showAppointment(appointment) {
  currentAppointment.value = appointment;
  showAppointmentDialog.value = true;
}

</script>

<template>
  <VCard>
    <VCardTitle class="d-flex justify-space-between">
      <p>{{$t('app.dashboard.latest_appointments.title')}}</p>
      <VBtn variant="tonal" @click="router.push(localePath('/dashboard/calendar'))">
        {{$t('app.dashboard.latest_appointments.action_btn')}}
      </VBtn>
    </VCardTitle>

    <VCardText>
      <VList subheader two-line rounded>


        <div v-if="loading">
          <v-skeleton-loader
              type="article"
              loading
              class="mt-4"
          />
          <v-skeleton-loader
              type="article"
              loading
              class="mt-4"
          />
        </div>

        <VListItem
            v-for="(appointment, i) in appointments"
            v-else-if="!loading && appointments.length > 0"
            :key="i"
        >
          <!--        <v-list-item-avatar>-->
          <!--          <v-icon class="grey lighten-1" dark>-->
          <!--            mdi-calendar-->
          <!--          </v-icon>-->
          <!--        </v-list-item-avatar>-->

          <!--        <v-list-item-content>-->
          <!--          <v-list-item-title v-text="appointment.customerable.full_name"></v-list-item-title>-->

          <!--          <v-list-item-subtitle v-text="`${appointment.date} ${appointment.start_time}`"></v-list-item-subtitle>-->
          <!--        </v-list-item-content>-->

          <v-list-item-action>
            <v-btn rounded elevation="1" @click="showAppointment(appointment)">View</v-btn>
          </v-list-item-action>
        </VListItem>

        <div v-else class="px-4 mt-3"><i>{{$t('app.dashboard.latest_appointments.subtitle')}}</i></div>
      </VList>
    </VCardText>
  </VCard>
</template>

<style scoped>
.wrapper {
  height: 350px;
  overflow-y: scroll;
}
</style>
