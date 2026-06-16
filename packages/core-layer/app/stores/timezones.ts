
import { defineStore } from 'pinia'
import {ref} from 'vue'
import {type Timezone} from "~/types";
import {useSanctumClient} from "#imports";


export const useTimezonesStore = defineStore('timezones', () => {
  const client = useSanctumClient()
  const timezones = ref<Timezone[]>([])
  const loading = ref(false)
  const isInitialized = ref(false)

  async function fetch(params = '') {
    if (isInitialized.value) return

    let error = false
    loading.value = true
    const fetchedTimezones = await client<Timezone[]>(`/timezones${params}`).catch(() => {
      error = true
    })
    loading.value = false

    if (error) {
      throw Error('Unable to retrieve categories')
    }

    isInitialized.value = true
    timezones.value = fetchedTimezones!
  }

  return {loading, timezones, fetch}
})
