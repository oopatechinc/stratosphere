import type { Category } from './category.type'
import type { Staff } from './staff.type'
import type { Service } from './service.type'
import type { Location } from './location.type'
import type { Subscription } from './subscription.type'
import type { Plugin } from './plugin.type'
import type { Vertical } from './vertical.type'

export type Tenant = {
  id?: number
  vertical_id?: number | undefined
  language_id?: number | undefined
  name?: string
  description?: string
  business_number?: string
  morph_class?: string
  remaining_trial_period_days: number
  subscription: Subscription
  categories?: Category[]
  services: Service[]
  staff?: Staff[]
  locations?: Location[]
  plugins?: Plugin
  vertical: Vertical
}
