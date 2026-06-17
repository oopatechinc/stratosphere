<script setup lang="ts">
import { onMounted, ref } from 'vue'
import type {CalendarEvent, CalendarEventOverlapMode} from "vuetify/lib/components/VCalendar/types.js";
import {useI18n} from "#imports"

const emit = defineEmits(['eventClicked'])

interface Props {
  events: CalendarEvent[],
  showTopToolbar?: boolean,
  showSideDropdown?: boolean
}

const {t} = useI18n()

defineProps<Props>()

const calendar = ref()

const type = ref<"4day" | "category" | "custom-daily" | "custom-weekly" | "day" | "month" | "week">('month')
const types = [
    {title: t('app.calendar.month'), value: "month",},
    {title: t('app.calendar.week'), value: "week"},
    {title: t('app.calendar.day'), value: "day"},
    {title: t('app.calendar.4day'), value: "4day"}
]
const mode = ref<"stack" | "column">('stack')
const overlapThreshold = ref(30)
const modes = [
  {title: t('app.calendar.stack'), value: 'stack'},
  {title: t('app.calendar.column'), value: 'column'},
]
const selectedWeekdays = ref({ id: 3, title: t('app.calendar.mon_fri'), weekdays: [1, 2, 3, 4, 5] })
const weekdays = [
  { id: 1, title: t('app.calendar.sun_sat'), digits: [0, 1, 2, 3, 4, 5, 6] },
  { id: 2, title: t('app.calendar.mon_sun'), digits: [1, 2, 3, 4, 5, 6, 0] },
  { id: 3, title: t('app.calendar.mon_fri'), digits: [1, 2, 3, 4, 5] },
  { id: 4, title: t('app.calendar.mon_wed_fri'), digits: [1, 3, 5] },
]

const focus = ref('')
const selectedEvent = ref({})
const selectedElement = ref(null)
const selectedOpen = ref(false)

const weekday = computed(() => {
  const weekday = weekdays.find(w => w.id === selectedWeekdays.value.id)
  return weekday?.digits
})

onMounted(() => {
  calendar.value.checkChange()
})

function viewDay (nativeEvent, { date }) {
  focus.value = date
  type.value = 'day'
}
function getEventColor (event) {
  return event.color
}
function setToday () {
  focus.value = ''
}
function prev () {
  calendar.value.prev()
}
function next () {
  calendar.value.next()
}
function showEvent (nativeEvent, { event }) {
  const open = () => {
    selectedEvent.value = event
    selectedElement.value = nativeEvent.target
    requestAnimationFrame(() => requestAnimationFrame(() => selectedOpen.value = true))
  }
  if (selectedOpen.value) {
    selectedOpen.value = false
    requestAnimationFrame(() => requestAnimationFrame(() => open()))
  } else {
    open()
  }
  nativeEvent.stopPropagation()
}
</script>

<template>
  <VSheet v-if="showTopToolbar" class="d-flex" tile elevation="2">
    <VBtn
        class="ma-2"
        variant="text"
        icon
        @click="$refs.calendar.prev()"
    >
      <v-icon>mdi-chevron-left</v-icon>
    </VBtn>
    <VSelect
        v-model="type"
        :items="types"
        class="ma-2"
        density="comfortable"
        :label="$t('app.calendar.view')"
        variant="outlined"
        hide-details
    >
      <template #selection="{item}">
        <span class="text-capitalize">{{item.title}}</span>
      </template>
      <template #item="{ props: itemProps }">
        <v-list-item v-bind="itemProps" />
      </template>
    </VSelect>
    <VSelect
        v-model="mode"
        :items="modes"
        class="ma-2"
        density="comfortable"
        :label="$t('app.calendar.event_overlap_mode')"
        variant="outlined"
        hide-details
    />
    <VSelect
        v-model="selectedWeekdays"
        :items="weekdays"
        class="ma-2"
        density="comfortable"
        :label="$t('app.calendar.weekdays')"
        variant="outlined"
        hide-details
        return-object
    />
    <VSpacer />
    <VBtn
        class="ma-2"
        variant="text"
        icon
        @click="$refs.calendar.next()"
    >
      <VIcon>mdi-chevron-right</VIcon>
    </VBtn>
  </VSheet>
  <VRow class="fill-height">
    <VCol>
      <VSheet height="64">
        <VToolbar flat>
          <VBtn
              class="me-4"
              color="grey-darken-2"
              variant="outlined"
              :text="$t('app.calendar.today')"
              @click="setToday"
          />
          <VBtn
              color="grey-darken-2"
              size="small"
              variant="text"
              icon
              @click="prev"
          >
            <VIcon size="small">
              mdi-chevron-left
            </VIcon>
          </VBtn>
          <VBtn
              color="grey-darken-2"
              size="small"
              variant="text"
              icon
              @click="next"
          >
            <VIcon size="small">
              mdi-chevron-right
            </VIcon>
          </VBtn>
          <VToolbarTitle v-if="calendar">
            {{ calendar.title }}
          </VToolbarTitle>
          <VSelect
              v-if="!showTopToolbar"
              v-model="type"
              :items="types"
              class="ma-2"
              density="comfortable"
              :label="$t('app.calendar.view')"
              variant="outlined"
              hide-details
          >
            <template #selection="{item}">
              <span class="text-capitalize">{{item.title}}</span>
            </template>
            <template v-slot:item="{ props: itemProps, item }">
              <v-list-item v-bind="itemProps"></v-list-item>
            </template>
          </VSelect>
        </VToolbar>
      </VSheet>
      <VSheet height="600">
        <VCalendar
            ref="calendar"
            v-model="focus"
            :event-color="getEventColor"
            :events="events"
            :event-overlap-mode="mode"
            :event-overlap-threshold="overlapThreshold"
            :weekdays="weekday"
            :type="type"
            color="primary"
            @click:date="viewDay"
            @click:event="showEvent"
            @click:more="viewDay"
        />
        <VMenu
            v-model="selectedOpen"
            :activator="selectedElement"
            :close-on-content-click="false"
            location="end"
        >
          <VCard
              color="grey-lighten-4"
              min-width="350px"
              flat
          >
            <VToolbar
                :color="selectedEvent.color"
                dark
            >
              <VBtn icon @click="emit('eventEditClicked', selectedEvent.timeBlockId)">
                <VIcon>mdi-pencil</VIcon>
              </VBtn>
              <VToolbarTitle v-html="selectedEvent.name" />
              <VBtn icon>
                <VIcon>mdi-heart</VIcon>
              </VBtn>
              <VBtn icon>
                <VIcon>mdi-dots-vertical</VIcon>
              </VBtn>
            </VToolbar>
            <VCardText>
              <span v-html="selectedEvent.details"></span>
            </VCardText>
            <VCardActions>
              <VBtn
                  color="secondary"
                  variant="text"
                  @click="selectedOpen = false"
              >
                Cancel
              </VBtn>
            </VCardActions>
          </VCard>
        </VMenu>
      </VSheet>
    </VCol>
  </VRow>
</template>

<style scoped>

</style>