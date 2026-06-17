<script setup lang="ts">
const props = defineProps({
  color: {
    type: String,
    default: 'primary'
  },
  title: {
    type: String,
    required: true
  },
  amount: {
    type: Number,
    required: true
  }
})
</script>

<template>
    <div>
      <VCard min-height="150" :color="props.color" class="text-center pa-1">
        <h3 class="pt-6 white--text">{{props.title}}</h3>
        <VCardText>
          <h3 class="white--text">{{props.amount}}</h3>
        </VCardText>
      </VCard>
    </div>
</template>
