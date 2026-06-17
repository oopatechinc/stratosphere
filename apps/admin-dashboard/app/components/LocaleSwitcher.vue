<script setup lang="ts">
import {useLocale} from "vuetify"
const {current} = useLocale()

const { locales, locale, setLocale } = useI18n()

const currentLocale = ref(locale.value)

function updateLocale(locale: "en-US" | "fr-CA") {
  setLocale(locale)
  current.value = locale.split('-')[0]!
}

</script>

<template>
  <div class="mt-3 d-flex">
    <VSelect
        v-model="currentLocale"
        flat
        :items="locales"
        item-title="name"
        item-value="code"
        density="compact"
        variant="solo-filled"
        rounded
        prepend-icon="mdi-web"
        @update:model-value="updateLocale"
    />
  </div>
</template>


<style scoped>

</style>