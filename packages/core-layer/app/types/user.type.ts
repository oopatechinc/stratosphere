import type { Staff } from './staff.type'
import type { Address } from './address.type'
import type {Tenant} from './tenant.type'

export type User = {
  id?: number
  tenant_id?: number
  preferred_language_id?: number
  timezone_id?: number
  first_name: string
  last_name: string
  full_name?: string
  email: string
  phone?: string
  image_url?: string
  type?: string
  morph_class?: string
  staff?: Staff
  address?: Address,
  tenant?: Tenant
}
