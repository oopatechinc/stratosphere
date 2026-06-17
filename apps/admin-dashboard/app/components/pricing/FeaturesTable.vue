<script setup lang="ts">
import {useDisplay} from "vuetify/framework";

const display = useDisplay()

const features = [
  {
    type: 'header',
    name:'Scheduling'
  },
  {
    type: 'feature',
    name: 'Email notifications',
    description: 'Your customers will get a timely email reminder of their upcoming booking. To minimize no-shows',
    solo: true,
    team: true
  },
  {
    type: 'feature',
    name: 'Timezone-optimized bookings',
    description: 'Your booking times will be translated to the timezone of your customer\'s location. ',
    solo: true,
    team: true
  },
  {
    type: 'feature',
    name: 'Block off breaks and personal time',
    description: 'Block off times for those moments when you need it',
    solo: true,
    team: true
  },
  {
    type: 'feature',
    name: 'SMS notifications',
    description: 'Your customers will get a timely sms reminder of their upcoming booking. To minimize no-shows',
    solo: true,
    team: true
  },
  {
    type: 'feature',
    name: 'Customized schedule for each staff',
    description: 'Your employees have the ability to customize their available opening hours and closing hours',
    solo: false,
    team: true
  },
  {
    type: 'header',
    name:'Online Bookings'
  },
  {
    name: 'Booking website',
    description: 'Choose from a list of curated website templates and customize to your business',
    solo: true,
    team: true
  },
  {
    name: 'Marketplace booking page',
    description: 'Get free placement on the Bookisia marketplace to boost your business',
    solo: true,
    team: true
  },
  {
    name: 'Sync appointment with calendars',
    description: 'When you add google calendar as an integration, a new event will automatically be added when your customers book your services',
    solo: true,
    team: true
  },
  {
    type: 'header',
    name:'Admin Tools'
  },
  {
    name: 'Add new staff',
    description: 'New employees get access to their own dashboard and can manage their hours and appointments',
    solo: false,
    team: true
  },
  {
    name: 'Enforce business opening hours across staff',
    description: 'Staff can modify their opening hours except if restricted by business',
    solo: false,
    team: true
  },
  {
    name: 'Enforce single business calendar across staff',
    description: 'Staff can use their own calendar except if restricted by business',

    solo: false,
    team: true
  },
  {
    name: 'Service pricing and durations per employee ',
    description: 'Staff can modify their pricings and service durations except if restricted by business',
    solo: false,
    team: true
  }
]
</script>

<template>
  <VTable class="bg-transparent">
    <thead>
    <tr>
      <th class="text-left pb-10">
        <h3>Plans</h3>
      </th>
      <th class="text-left pb-10">
        <h3>Solo</h3>
        <span>$29.99/month</span>

      </th>
      <th class="text-left pb-10">
        <h3>Teams</h3>
        <span>$19.99/month</span>
        <div><p class="v-card-subtitle pl-0">Per team member</p></div>
      </th>
    </tr>
    </thead>
    <tbody>
    <template v-for="(feature, i) in features" :key="i">
      <tr v-if="feature.type === 'header'" >
        <td colspan="3"><h3>{{feature.name}}</h3></td>
      </tr>
      <tr v-else>
        <td>
          {{ feature.name }}
          <VTooltip v-if="display.mdAndUp.value" :text="feature.description" location="bottom">
            <template #activator="{props}">
              <v-icon color="primary" v-bind="props">mdi-information</v-icon>
            </template>

          </VTooltip>
        </td>
        <td><VIcon>{{feature.solo ? 'mdi-check' : 'mdi-cancel'}}</VIcon></td>
        <td><VIcon>{{feature.team ? 'mdi-check' : 'mdi-cancel'}}</VIcon></td>
      </tr>
    </template>
    </tbody>
  </VTable>
</template>

<style scoped>

</style>