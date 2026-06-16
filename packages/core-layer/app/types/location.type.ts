import type { Address } from './address.type'
import type { OpeningDay } from './opening-day.type'
import type { OpeningHourException } from './opening-hour-exception.type'
import type { Staff } from './staff.type'
import type { Service } from './service.type'
import type { Tenant } from './tenant.type'
import type { WebsiteTemplate } from './website-template.type'
import type { WebsiteContent } from './website-content.type'

export type Location = {
  id?: number
  tenant_id: number
  website_template_id: number
  language_id: number
  timezone_id: number
  nickname: string
  type?: string
  subdomain: string
  email: string
  phone: string
  x_account: string
  instagram_account: string
  facebook_account: string
  linkedin_account: string
  address: Address
  opening_days: OpeningDay[]
  opening_hour_exceptions: OpeningHourException[]
  staff: Staff[]
  services: Service[]
  tenant: Tenant
  website_template: WebsiteTemplate
  website_contents: WebsiteContent[]
}
