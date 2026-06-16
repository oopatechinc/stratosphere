import { computed } from 'vue'
import { useEditorStore } from '@/stores/editor'

export const useBlueprintField = (sectionId: string, key: string, type: 'fields' | 'styles' = 'fields') => {
  const store = useEditorStore()

  const value = computed({
    get: () => {
      const section = store.draftConfig?.sections?.find((s: any) => s.id === sectionId)
      return section?.[type]?.[key]
    },
    set: (val) => {
      if (type === 'fields') {
        store.updateField(sectionId, key, val)
      } else {
        store.updateStyle(sectionId, key, val)
      }
    }
  })

  return value
}
