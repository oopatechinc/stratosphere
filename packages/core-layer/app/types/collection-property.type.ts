import type { CollectionPropertyImage } from './collection-property-image.type'

export type CollectionProperty = {
  id: number | undefined
  name: string | undefined
  address: string | undefined
  beds: number | undefined
  baths: number | undefined
  rooms: number | undefined
  images: CollectionPropertyImage []
}
