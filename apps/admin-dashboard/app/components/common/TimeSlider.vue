<script setup lang="ts">

const appointmentLength = defineModel<number>({default: 30})

const step = 5

function decrement () {
  appointmentLength.value -= step
}

function increment () {
  appointmentLength.value += step
}

function formatDuration(val: number) {
  const hours = Math.floor(val / 60);
  const  minutes = val % 60;

  if (hours === 0) {
    return `${minutes} minutes`;
  }

  return `${hours} ${hours > 1 ? 'hours' : 'hour'} ${minutes} minutes`;
}
</script>

<template>
    <VCard>
      <VCardText>
        <VRow class="mb-4" justify="space-between">
          <VCol class="text-left">
            <p class="title-text">{{formatDuration(appointmentLength)}}</p>
          </VCol>
        </VRow>

        <VSlider
            v-model="appointmentLength"
            track-color="grey"
            always-dirty
            min="5"
            max="1440"
            :step="step"
            :thumb-size="24"
            thumb-label="always"
        >
          <template #prepend>
            <VIcon color="primary" @click="decrement">mdi-minus</VIcon>
          </template>

          <template #append>
            <VIcon @click="increment">mdi-plus</VIcon>
          </template>
        </VSlider>
      </VCardText>
    </VCard>
</template>

<style scoped>
.title-text {
  font-size: 2rem;
}
</style>