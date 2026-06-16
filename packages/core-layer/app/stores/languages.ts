
import { defineStore } from 'pinia'
import {ref} from 'vue'
import type {Language} from "~/types";
import {useSanctumClient} from "#imports";


export const useLanguagesStore = defineStore('languages', () => {
  const client = useSanctumClient()

  const languages = ref<Language[]>([])
  const loading = ref(false)
  const isInitialized = ref(false)

  async function fetch(params = '') {
    if (isInitialized.value) return

    let error = false
    loading.value = true
    const fetchedLanguages = await client<Language[]>(`/languages${params}`).catch(() => {
      error = true
    })
    loading.value = false

    if (error) {
      throw Error('Unable to retrieve countries')
    }

    isInitialized.value = true
    languages.value = fetchedLanguages!
  }

  return {loading, languages, fetch}
})
