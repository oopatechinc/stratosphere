<script setup lang="ts">
import type {TimeBlock, User} from "@stratosphere/core-layer/types"
import TimeBlockForm from "~/components/team-member/TimeBlockForm.vue";
import type {CalendarEvent} from "vuetify/lib/components/VCalendar/types.js";

const user = useSanctumUser<User>()
const {fetch} = useTimeBlockFrequenciesStore()
fetch()

const timeBlocks = defineModel<TimeBlock[]>()

const showTimeBlockDialog = ref(false)
const dayjs = useDayjs()

const currentTimeBlock = ref<TimeBlock>()

const initialTimeBlock = {
  id: -1,
  staff_id: user.value!.staff!.id!,
  reason: '',
  dates: [{date: dayjs().format('LL')}],
  starts_at: '',
  ends_at: '',
  is_all_day: false,
  time_block_frequency_id: 1,
} as TimeBlock

const timeBlockEvents = ref<CalendarEvent[]>([])
createEvents()

function handleShowDialog(timeBlockId: number) {
  if (timeBlockId == -1) {
    currentTimeBlock.value = initialTimeBlock
  } else {
    currentTimeBlock.value = timeBlocks.value!.find(tb => tb.id == timeBlockId)
  }

  showTimeBlockDialog.value = true
}

function handleTimeBlockSubmit() {
  const timeBlockIndex = timeBlocks.value!.findIndex(tb => tb.id === Number(currentTimeBlock.value?.id))

  if (timeBlockIndex !== -1) {
    timeBlocks.value![timeBlockIndex] = currentTimeBlock.value!
  } else {
    timeBlocks.value!.push(currentTimeBlock.value!)
  }

  showTimeBlockDialog.value = false
}

interface DateRecord {
  date: string; // YYYY-MM-DD from Laravel
}

function createEvents() {
  timeBlocks.value!.forEach(timeBlock => {
    const sortedMoments = timeBlock.dates
        .map((d: DateRecord) => dayjs(d.date))
        .sort((a, b) => a.valueOf() - b.valueOf());

    if (sortedMoments.length === 0) return [];

    let rangeStart = sortedMoments[0]!;
    let rangeEnd = sortedMoments[0]!;

    for (let i = 1; i <= sortedMoments.length; i++) {
      const current = sortedMoments[i];

      // Check if 'current' is exactly 1 day after 'rangeEnd'
      if (current && current.isSame(dayjs(rangeEnd).add(1, 'days'), 'day') && timeBlock.is_all_day) {
        rangeEnd = current;
      } else {
        // 2. Format the block strings
        const startStr = rangeStart.format('YYYY-MM-DD');
        const endStr = rangeEnd.format('YYYY-MM-DD');

        timeBlockEvents.value.push({
          timeBlockId: timeBlock.id,
          name: timeBlock.reason || 'Time Block',
          start: timeBlock.is_all_day
              ? startStr
              : `${startStr} ${timeBlock.starts_at}`,
          end: timeBlock.is_all_day
              ? endStr
              : `${endStr} ${timeBlock.ends_at}`,
          allDay: timeBlock.is_all_day,
          color: 'blue',
        });

        // 3. Reset for the next sequence
        if (current) {
          rangeStart = current;
          rangeEnd = current;
        }
      }
    }
  })
}

function handleCalendarEventClicked(timeBlockId: number) {
}

// function createEvents () {
  // timeBlocks.value!.forEach(timeBlock => {
  //   timeBlock.dates.forEach(timeBlockDate => {
  //
  //     const min = moment(`${timeBlockDate.date}T${timeBlock.starts_at}`)
  //     const max = moment(`${timeBlockDate.date}T${timeBlock.ends_at}`)
  //
  //
  //     let startEndTimes = {}
  //     if (timeBlock.is_all_day) {
  //       const firstTimestamp = min.valueOf()
  //       const first = moment(firstTimestamp - (firstTimestamp % 900000)).valueOf()
  //       const secondTimestamp = 48 * 900000
  //       const second = moment(first + secondTimestamp).valueOf()
  //
  //       startEndTimes = {
  //         start: first,
  //         end: second,
  //       }
  //     } else {
  //       startEndTimes = {
  //         start: min.format('YYYY-MM-DD HH:mm'),
  //         end: max.format('YYYY-MM-DD HH:mm'),
  //       }
  //     }
  //
  //     blockedDates.value.push({
  //       name: `Blocked (${timeBlock.reason})`,
  //       color: 'grey',
  //       timed: false,
  //       ...startEndTimes
  //     })
  //
  //
  //   })
  // })
// }

function rnd (a, b) {
  return Math.floor((b - a + 1) * Math.random()) + a
}
</script>

<template>
  <div class="d-flex justify-space-between align-center">
    <h3 class="my-6">
      Time Blocks
      <VTooltip location="top">
        <template #activator="data">
          <VIcon v-bind="data.props" size="20">mdi-information</VIcon>
        </template>
        <span>Block specific times you do not want to be booked!</span>
      </VTooltip>
    </h3>
    <VBtn icon="mdi-plus" variant="tonal" size="x-small" @click="handleShowDialog(-1)"/>
  </div>
    <SharedCalendar
        :events="timeBlockEvents"
        @event-clicked="handleShowDialog"
    />

  <VDialog v-if="showTimeBlockDialog" v-model="showTimeBlockDialog" max-width="600">
    <TimeBlockForm
        v-model="currentTimeBlock"
        @submit="handleTimeBlockSubmit"
        @hide-dialog="showTimeBlockDialog=false"
    />
  </VDialog>
</template>

<style scoped>

</style>