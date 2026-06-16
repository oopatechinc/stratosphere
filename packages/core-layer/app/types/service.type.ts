import type { ServiceVariation } from './servicevariation.type'
import type { Category } from './category.type'

export type Service = {
  id?: number
  tenant_id?: number
  name?: string
  description?: string
  image_url?: string
  variations?: ServiceVariation[]
  categories?: Category[]
}
