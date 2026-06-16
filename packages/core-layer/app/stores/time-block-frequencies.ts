
import { defineStore } from 'pinia'
import {ref} from 'vue'
import {type TimeBlockFrequency} from "~/types"
import {useSanctumClient} from "#imports";


export const useTimeBlockFrequenciesStore = defineStore('time-block-frequencies', () => {
  const client = useSanctumClient()
  const timeBlockFrequencies = ref<TimeBlockFrequency[]>([])
  const loading = ref(false)
  const isInitialized = ref(false)

  async function fetch(params = '') {
    if (isInitialized.value) return

    let error = false
    loading.value = true
    const fetchedTimeBlockFrequencies = await client<TimeBlockFrequency[]>(`/time-block-frequencies${params}`).catch(() => {
      error = true
    })
    loading.value = false

    if (error) {
      throw Error('Unable to retrieve time block frequencies')
    }

    isInitialized.value = true
    timeBlockFrequencies.value = fetchedTimeBlockFrequencies!
  }

  return {loading, timeBlockFrequencies, fetch}
})
