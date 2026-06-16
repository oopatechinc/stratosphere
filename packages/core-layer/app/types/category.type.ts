import type { Service } from './service.type'

export type Category = {
  id?: number
  tenant_id?: number
  name?: string
  image_url?: string
  services?: Service[]
}
