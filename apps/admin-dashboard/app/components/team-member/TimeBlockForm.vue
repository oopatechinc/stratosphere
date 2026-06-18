<script setup lang="ts">
import {useValidationRules} from "#imports";
import type {TimeBlock} from "@stratosphere/core-layer/types"

const {genericRequiredRule} = useValidationRules()
const {timeBlockFrequencies} = useTimeBlockFrequenciesStore()
const dayjs = useDayjs()
const dates = dayjs().format('LL')


const timeBlock = defineModel<TimeBlock>({
  default: () => [{
    staff_id: -1,
    reason: '',
    dates: [dates],
    starts_at: null,
    ends_at: null,
    is_all_day: false,
    time_block_frequency_id: 0,
  }]
})

const emit = defineEmits(['hideDialog', 'submit'])

const showDateMenu = ref(false)
const showStartTimeMenu = ref(false)
const showEndTimeMenu = ref(false)
const formValidity = ref(null)
const selectedDates = ref<string[]>([])

const formattedDates = computed(() => {
  const maxReturnedDates = 2
  const remainingDateCount = timeBlock.value.dates.length - maxReturnedDates
  const moreText = `${timeBlock.value.dates.length > maxReturnedDates
      ? ` (+${remainingDateCount} more date${remainingDateCount > 1 ? 's' : ''})`
      : ''}`

  return timeBlock.value.dates.filter((d, index) => index + 1 <= maxReturnedDates).map(d => {
    return dayjs(d.date).format('LL')
  }).join(', ') + moreText
})

// get dates
selectedDates.value = timeBlock.value!.dates.map(tbd => tbd.date)

function onDateUpdate() {
  timeBlock.value.dates = selectedDates.value.map(date => {
    return {time_block_id: timeBlock.value.id, date: dayjs(date).format('YYYY-MM-DD')}
  })
}

function submit() {
  if (formValidity.value !== true) return
  emit('submit')
}
</script>

<template>


  <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="submit">
    <VCard>
      <VCardTitle class="d-flex justify-space-between align-center bg-primary">
        Add New Time Block
        <VBtn icon="mdi-close" color="primary" flat @click="emit('hideDialog')" />
      </VCardTitle>
      <VCardText>
        <div>
          <VTextField
              v-model="timeBlock.reason"
              label="Reason"
              prepend-icon="mdi-calendar-text"
              class="text-wrap"
              :rules="genericRequiredRule('The reason for the time block is required')"
          />
          <VTextField
              :model-value="formattedDates"
              label="Select Dates"
              prepend-icon="mdi-calendar-multiselect"
              readonly
          >
            <VMenu
                v-model="showDateMenu"
                :close-on-content-click="false"
                activator="parent"
                min-width="0"
            >
              <VDatePicker
                  v-model="selectedDates"
                  multiple
                  @update:model-value="onDateUpdate"/>
            </VMenu>
          </VTextField>
        </div>

        <div class="d-flex justify-space-between align-center">
          <div>
            <label>
              <VIcon color="grey-darken-1" class="mr-3">mdi-calendar-lock</VIcon>
              Block entire day
            </label>
          </div>
          <VSwitch v-model="timeBlock.is_all_day" :color="timeBlock.is_all_day? 'success' : ''" inset/>
        </div>

        <VSelect
            v-model="timeBlock.time_block_frequency_id"
            :items="timeBlockFrequencies"
            item-title="frequency"
            item-value="id"
            label="Frequency"
            prepend-icon="mdi-alarm"
        />


        <VRow v-if="!timeBlock.is_all_day" no-gutters>
          <VCol cols="12" md="6">
            <VTextField
                :model-value="timeBlock.starts_at"
                label="Select Start Time"
                prepend-icon="mdi-clock"
                readonly
                :rules="genericRequiredRule('Start time is required')"
            >
              <VMenu
                  v-model="showStartTimeMenu"
                  :close-on-content-click="false"
                  activator="parent"
                  min-width="0"
              >
                <VTimePicker v-model="timeBlock.starts_at"/>
              </VMenu>
            </VTextField>
          </VCol>
          <VCol cols="12" md="6">
            <VTextField
                :model-value="timeBlock.ends_at"
                label="Select End Time"
                prepend-icon="mdi-clock"
                readonly
                :rules="genericRequiredRule('End time is required')"
            >
              <VMenu
                  v-model="showEndTimeMenu"
                  :close-on-content-click="false"
                  activator="parent"
                  min-width="0"
              >
                <VTimePicker v-model="timeBlock.ends_at"/>
              </VMenu>
            </VTextField>
          </VCol>
        </VRow>
      </VCardText>
      <VCardActions>
        <VBtn block elevation="1" class="bg-primary" type="submit">Submit</VBtn>
      </VCardActions>
    </VCard>
  </VForm>
</template>

<style scoped>

</style>