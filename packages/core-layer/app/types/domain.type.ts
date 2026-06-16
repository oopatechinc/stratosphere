import type { Staff } from './staff.type'
import type { Location } from './location.type'

export type Domain = {
  id: number
  tenant_id: number
  url: string
  domainable_type: string
  domainable_id: string
  domainable?: Staff | Location
}
