import type { CollectionItem } from "@stratosphere/core-layer/types"

export const useCollectionsStore = defineStore('collections', () => {
    const client = useSanctumClient();

    const collectionItems = ref<CollectionItem[]>([])
    const loading = ref(false)
    const isInitialized = ref(false)

    async function fetch(type: string) {
        if (isInitialized.value) return

        let error = false
        loading.value = true
        const response = await client(`/collections/${type}`).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to retrieve collections')
        }

        isInitialized.value = true
        collectionItems.value = response as CollectionItem[]
    }

    async function getOne(id: number, type: string) {
        if (!isInitialized.value) await fetch(type)
        return collectionItems.value.find(c => c.id === id)
    }

    async function store(payload: CollectionItem) {
        let error = false
        loading.value = true
        const response = await client<CollectionItem>(
            '/collections',
            {method: 'POST', body: payload}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save property')
        }

        collectionItems.value.unshift(response as CollectionItem)
        return response as CollectionItem
    }

    async function update(collectionItem: CollectionItem, updateApi = false) {
        if (updateApi) {
             await client<CollectionItem>(`properties/${collectionItem.id}`, {method: 'PUT', body: collectionItem})
        }

        const index = collectionItems.value.findIndex(p => p.id === collectionItem.id)
        if (index == -1) return
        collectionItems.value[index] = collectionItem
    }

    return {loading, collectionItems, fetch, store, update, getOne}
})

