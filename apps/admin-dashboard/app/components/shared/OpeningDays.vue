<script setup lang="ts">
import type {OpeningDay, OpeningHour} from "@stratosphere/core-layer/types"
import moment from "moment-timezone"
import {DAY_OF_WEEKS} from "~/utils/constants";

const openingDays = defineModel<OpeningDay[]>()
const selectedType = ref('')
const selectedOpeningDay = ref<OpeningDay>()
const selectedOpeningHour = ref<OpeningHour>()
const timepicker = ref('')
const showTimePicker = ref(false)
const dayjs = useDayjs()

const {t} = useI18n()


function handleCheckboxClicked(day: OpeningDay) {

}

function handleEditTime(type: string, openingDay: OpeningDay, openingHour: OpeningHour) {
  selectedType.value = type
  selectedOpeningDay.value = openingDay
  selectedOpeningHour.value = openingHour

  timepicker.value = type === 'opens_at' ? openingHour.opens_at : openingHour.closes_at
  showTimePicker.value = true
}

function updateTime() {
  const openingDayIndex = openingDays.value!.findIndex(o => o.id === selectedOpeningDay.value?.id)

  const openingHourIndex = openingDays.value![openingDayIndex]!
      .opening_hours.findIndex(o => o.id === selectedOpeningHour.value?.id)


  if (selectedType.value == 'opens_at') {
    openingDays.value![openingDayIndex]!.opening_hours[openingHourIndex]!.opens_at = timepicker.value
  } else {
    openingDays.value![openingDayIndex]!.opening_hours[openingHourIndex]!.closes_at = timepicker.value
  }

  showTimePicker.value = false
}

function formatTime(isActive: boolean, time: string) {
  if (!isActive) return ""
  return moment(time, 'hh:mm').format('hh:mm A')
}

function addNewTime(dayIndex: number) {
  openingDays.value![dayIndex]!.opening_hours.push(
      {
        id: -1,
        opening_day_id: -1,
        opens_at: '9:00',
        closes_at: '12:00',
      }
  )
}

function removeTime(dayIndex: number, hourIndex: number) {
  openingDays.value![dayIndex]!.opening_hours.splice(hourIndex, 1)
}

function getI18nDay(dayNumber: number) {
  const dayName = dayjs().day(dayNumber).format('dddd')
  return  t(`app.days.${dayName}`)
}
</script>

<template>
  <div>
    <VRow no-gutters>
      <VCol v-for="(day, i) in openingDays" :key="i" cols="12" class="align-center">
        <VRow>
          <VCol cols="4">
            <VCheckbox
                v-model="day.is_active"
                :label="getI18nDay(day.day_of_week)"
                :disabled="disableCheckbox && !day.is_active"
                @click="handleCheckboxClicked(day)"
            />
          </VCol>
          <VCol cols="8">
            <VRow v-for="(openingHour, j) in day.opening_hours" :key="j">
              <VCol cols="6">
                <VTextField
                    :model-value="formatTime(day.is_active, openingHour.opens_at)"
                    :label="day.is_active ? $t('app.locations.form.business_hours.opens_at') : $t('app.locations.form.business_hours.closed')"
                    density="compact"
                    variant="outlined"
                    :disabled="!day.is_active"
                    readonly
                >
                  <VMenu
                      :close-on-content-click="false"
                      activator="parent"
                      min-width="0"
                  >
                    <VTimePicker v-model="openingHour.opens_at"/>
                  </VMenu>
                </VTextField>
              </VCol>
              <VCol cols="6">
                <VTextField
                    :model-value="formatTime(day.is_active, openingHour.closes_at)"
                    :label="day.is_active ? $t('app.locations.form.business_hours.closes_at') : $t('app.locations.form.business_hours.closed')"
                    density="compact"
                    variant="outlined"
                    :disabled="!day.is_active"
                    readonly
                >
                  <VMenu
                      :close-on-content-click="false"
                      activator="parent"
                      min-width="0"
                  >
                    <VTimePicker v-model="openingHour.closes_at"/>
                  </VMenu>
                </VTextField>
              </VCol>
            </VRow>
            <div class="d-flex justify-end mb-6 mr-16">
              <span v-if="day.is_active" class="text-decoration-underline cursor-pointer" @click="addNewTime(i)">
                {{$t('app.locations.form.business_hours.add_new_time')}}
              </span>
            </div>
          </VCol>
        </VRow>
      </VCol>
    </VRow>
  </div>
</template>

<style scoped>

</style>