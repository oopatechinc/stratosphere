import { ref, onMounted } from 'vue'

interface DataSource {
  type: 'static' | 'dynamic'
  endpoint?: string
  items?: any[]
}

interface Mappings {
  [key: string]: string
}

export const useDynamicCollection = (dataSource: DataSource, mappings: Mappings, websiteId: number) => {
  const items = ref<any[]>([])
  const loading = ref(false)
  const error = ref<string | null>(null)
  
  const fetchDynamicData = async () => {
    if (!dataSource.endpoint) return
    
    loading.value = true
    const client = useSanctumClient()
    try {
      // Append website_id to scope the collection to the current tenant
      const data = await client<any[]>(`${dataSource.endpoint}?website_id=${websiteId}`)

      items.value = data.map((item: any) => {
        const mapped: any = { id: item.id }
        Object.keys(mappings).forEach(key => {
          mapped[key] = item[mappings[key]]
        })
        return mapped
      })
    } catch (err: any) {
      error.value = err.message || 'Failed to fetch collection data'
      console.error(err)
    } finally {
      loading.value = false
    }
  }

  onMounted(() => {
    if (dataSource.type === 'dynamic') {
      fetchDynamicData()
    } else {
      items.value = dataSource.items || []
    }
  })

  return {
    items,
    loading,
    error,
    refresh: fetchDynamicData
  }
}
