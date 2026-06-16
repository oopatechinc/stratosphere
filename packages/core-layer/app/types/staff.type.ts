import type { User } from './user.type'
import type { Tenant } from './tenant.type'
import type { Occupation } from './occupation.type'
import type { Service } from './service.type'
import type { OpeningDay } from './opening-day.type'
import type { OpeningHourException } from './opening-hour-exception.type'
import type { Location } from './location.type'
import type { Address } from './address.type'
import type { LocationService } from './location_service.type'
import type { TimeBlock } from './time-block.type'
import type { Appointment } from './appointment.type'

export type Staff = {
  id?: number
  user_id?: number
  status?: string
  user?: User
  image_url: string
  morph_class: string
  tenant?: Tenant
  occupations?: Occupation[]
  services?: Service[]
  locations?: Location[]
  location_services?: LocationService[]
  opening_days: OpeningDay[]
  opening_hour_exceptions: OpeningHourException[]
  address: Address
  time_blocks: TimeBlock[]
  appointments: Appointment[]
}
