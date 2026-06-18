import type {Category} from "@stratosphere/core-layer/types";

export const useCategoriesStore = defineStore('categories', () => {
    const client = useSanctumClient();

    const categories = ref<Category[]>([])
    const loading = ref(false)
    const isInitialized = ref(false)

    async function get() {
        if (isInitialized.value) return

        let error = false
        loading.value = true
        const fetchedCategories = await client<Category[]>('/categories').catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to retrieve categories')
        }

        isInitialized.value = true
        categories.value = fetchedCategories!
    }

    async function getOne(id: number) {
        if (!isInitialized.value) await get()
        return categories.value.find(c => c.id === id)
    }

    async function store(payload: Category) {
        let error = false
        loading.value = true
        const newCategory = await client<Category>(
            '/categories',
            {method: 'POST', body: payload}
        ).catch(() => {
            error = true
        })
        loading.value = false

        if (error) {
            throw Error('Unable to save category')
        }

        categories.value.unshift(newCategory!)
        return newCategory as Category
    }

    async function update(category: Category, updateApi = false) {
        if (updateApi) {
             category = await client<Category>(`/categories/${category.id}`, {method: 'PUT', body: category})
        }

        const index = categories.value.findIndex(c => c.id === category.id)
        if (index == -1) return
        categories.value[index] = category
    }

    return {loading, categories, get, getOne, store, update}
})