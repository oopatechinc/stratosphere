import type { Service, Staff } from "~/types"
import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useSanctumClient } from '#imports'

export const useStaffsStore = defineStore('staffs', () => {
  const client = useSanctumClient()

  const staffs = ref<Staff[]>([])
  const loading = ref(false)

  async function fetch(params = '') {
    if (staffs.value.length) return

    loading.value = true
    let error = false
    const fetchedStaffs = await client(`staffs${params}`).catch(() => {
      error = true
    }) as Staff[]

    loading.value = false

    if (error) {
      throw new Error('Unable to fetch staffs')
    }

    staffs.value = fetchedStaffs
  }

  async function get(staffId: number) {
    if (!staffs.value.length) await fetch()

    return staffs.value.find(c => c.id === staffId)
  }

  async function store(payload: Staff) {
    let error = false
    const staff = await client<Staff>('staffs', { method: 'POST', body: payload }).catch(() => {
      error = true
    }) as Staff

    if (error) {
      throw new Error('Unable to store staff')
    }

    staffs.value.push(staff)
    return staff
  }

  async function syncServices(staffId: number, payload: Service[]) {
    let error = false
    const staff = await client<Staff>(`staffs/${staffId}/sync-services`, { method: 'POST', body: { services: payload } }).catch(() => {
      error = true
    }) as Staff

    if (error) {
      throw new Error('Unable to sync staff services')
    }

    const index = staffs.value.findIndex(s => s.id === staffId)
    staffs.value[index] = staff
  }

  async function update(staff: Staff, updateApi = false) {
    if (updateApi) {
      await client<Staff>(`staffs/${staff.id}`, { method: 'PUT', body: staff })
    }

    const index = staffs.value.findIndex(s => s.id === staff.id)
    if (index == -1) return
    staffs.value[index] = staff
  }

  return { loading, staffs, fetch, get, store, update, syncServices }
})
