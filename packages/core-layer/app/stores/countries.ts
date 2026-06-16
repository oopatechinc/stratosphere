
import { defineStore } from 'pinia'
import {ref} from 'vue'
import {type Country} from "~/types";
import {useSanctumClient} from "#imports";


export const useCountriesStore = defineStore('countries', () => {
  const client = useSanctumClient()

  const countries = ref<Country[]>()
  const loading = ref(false)
  const isInitialized = ref(false)

  async function fetch(params = '') {
    if (isInitialized.value) return

    let error = false
    loading.value = true
    const fetchedCountries = await client<Country[]>(`/countries${params}`).catch(() => {
      error = true
    })
    loading.value = false

    if (error) {
      throw Error('Unable to retrieve countries')
    }

    isInitialized.value = true
    countries.value = fetchedCountries!
  }

  return {loading, countries, fetch}
})
