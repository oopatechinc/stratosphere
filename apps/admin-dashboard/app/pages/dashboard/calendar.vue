<script setup lang="ts">
import {useCalendar} from "#imports";

const {
  calendarEvents,
  handleEventClick
} = await useCalendar()
</script>

<template>
  <SharedCalendar
      :events="calendarEvents"
      :show-top-toolbar="true"
      @event-clicked="handleEventClick"
  />
</template>

<style scoped>

</style>