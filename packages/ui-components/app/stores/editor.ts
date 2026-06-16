import { defineStore } from 'pinia'

export const useEditorStore = defineStore('editor', {
  state: () => ({
    website: null as any,
    blueprint: null as any,
    draftConfig: null as any,
    loading: false,
    isSaving: false,
  }),
  actions: {
    async fetchWebsite(id: number) {
      const client = useSanctumClient()
      this.loading = true
      try {
        const data = await client<any>(`/websites/${id}`)
        this.website = data
        this.blueprint = data.theme.blueprint
        this.draftConfig = JSON.parse(JSON.stringify(data.active_config))
      } catch (error) {
        console.error('Failed to fetch website', error)
      } finally {
        this.loading = false
      }
    },
    async saveWebsite() {
      if (!this.website) return
      const client = useSanctumClient()
      try {
        this.isSaving = true
        await client(`/websites/${this.website.id}`, {
          method: 'PUT',
          body: { active_config: this.draftConfig }
        })
        this.isSaving = false
        this.website.active_config = JSON.parse(JSON.stringify(this.draftConfig))
      } catch (error) {
        console.error('Failed to save website', error)
      }
    },
    updateField(sectionId: string, key: string, value: any) {
      const section = this.draftConfig.sections.find((s: any) => s.id === sectionId)
      if (section) {
        section.fields[key] = value
      }
    },
    updateStyle(sectionId: string, key: string, value: any) {
      const section = this.draftConfig.sections.find((s: any) => s.id === sectionId)
      if (section) {
        section.styles[key] = value
      }
    },
    addSection(sectionType: string) {
      const blueprintSection = this.blueprint.schema.sections.find((s: any) => s.type === sectionType)
      if (blueprintSection) {
        const newSection = {
          id: `${sectionType}_${Date.now()}`,
          type: sectionType,
          fields: {},
          styles: {}
        }
        // Initialize fields/styles from blueprint defaults if needed
        blueprintSection.fields.forEach((f: any) => {
          newSection.fields[f.key] = ''
        })
        blueprintSection.styles.forEach((s: any) => {
          newSection.styles[s.key] = ''
        })
        this.draftConfig.sections.push(newSection)
      }
    },
    removeSection(sectionId: string) {
      this.draftConfig.sections = this.draftConfig.sections.filter((s: any) => s.id !== sectionId)
    },
    reorderSections(newOrder: any[]) {
      this.draftConfig.sections = newOrder
    }
  }
})
