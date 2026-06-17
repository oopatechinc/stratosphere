<script setup lang="ts">
const localePath = useLocalePath()
interface Props {
  platform: string,
  icon: string,
  card: {title: string, description: string}
}

defineProps<Props>()

const {integrations} = storeToRefs(useIntegrationsStore())

function isConnected(platform: string) {
  return integrations.value.filter(i => i.platform == platform).length
}

</script>

<template>
  <NuxtLink :to="localePath(`/dashboard/integrations/${platform}`)">
    <VCard height="150">
      <VCardText>
        <div class="d-flex justify-space-between">
          <VImg :src="`/icons/${icon}`" max-width="80" max-height="40"/>
          <VChip v-if="isConnected(platform)" color="green" :text="$t('app.dictionary.connected')" variant="outlined" />
        </div>
        <div class="my-2"><h5>{{$t(`app.integrations.${platform}.card.title`)}}</h5></div>
        <div><p>{{$t(`app.integrations.${platform}.card.description`)}}</p></div>
      </VCardText>
    </VCard>
  </NuxtLink>

</template>

<style scoped>

</style>