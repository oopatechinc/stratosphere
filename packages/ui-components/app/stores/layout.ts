import { defineStore } from 'pinia'

export type DeviceType = 'mobile' | 'tablet' | 'desktop'

export const useLayoutStore = defineStore('layout', {
  state: () => ({
    sidebarState: 'half' as 'hidden' | 'half' | 'full',
    activeMenu: 'sections' as 'sections' | 'theme' | 'pages' | 'settings',
    previewDevice: 'desktop' as DeviceType,
    isPreviewMode: false,
  }),
  getters: {
    sidebarWidth: (state) => {
      if (state.sidebarState === 'hidden') return 0
      if (state.sidebarState === 'half') return 480
      return '100%'
    },
    previewWidth: (state) => {
      if (state.sidebarState === 'full') return '0px'
      switch (state.previewDevice) {
        case 'mobile': return '375px'
        case 'tablet': return '768px'
        default: return '100%'
      }
    }
  },
  actions: {
    setSidebarState(state: 'hidden' | 'half' | 'full') {
      this.sidebarState = state
    },
    setActiveMenu(menu: 'sections' | 'theme' | 'pages' | 'settings') {
      this.activeMenu = menu
      if (this.sidebarState === 'hidden') this.sidebarState = 'half'
    },
    toggleSidebar() {
      if (this.sidebarState === 'hidden') this.sidebarState = 'half'
      else if (this.sidebarState === 'half') this.sidebarState = 'full'
      else this.sidebarState = 'hidden'
    },
    setDevice(device: DeviceType) {
      this.previewDevice = device
    },
    togglePreviewMode() {
      this.isPreviewMode = !this.isPreviewMode
      if (this.isPreviewMode) {
        this.sidebarState = 'hidden'
      } else {
        this.sidebarState = 'half'
      }
    }
  }
})
