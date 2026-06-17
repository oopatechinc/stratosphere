<script setup lang="ts">
defineProps({
  url: {
    type: String,
    required: true
  },
  text: {
    type: String,
    default: "You are about to be redirected to another page."
  }
})
const show = defineModel<boolean>({default: false})
</script>

<template>
  <VDialog v-if="show" v-model="show" max-width="600">
    <VCard>
      <VCardTitle class="bg-primary">{{$t('app.locations.form.business_hours.confirm_action.title')}}</VCardTitle>
      <VCardText>
        {{text}}
      </VCardText>
      <VCardActions>
        <VBtn @click="show=false">{{$t('app.dictionary.cancel')}}</VBtn>
        <VBtn color="primary" variant="outlined" @click="useRouter().push(url)">{{$t('app.dictionary.continue')}}</VBtn>
      </VCardActions>
    </VCard>
  </VDialog>
</template>

<style scoped>

</style>