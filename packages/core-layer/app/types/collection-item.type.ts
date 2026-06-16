import type { CollectionProperty } from './collection-property.type'
import type { Service } from './service.type'

export type CollectionItem = {
  id: number | undefined
  collection_type: string
  content: CollectionProperty | Service
}
