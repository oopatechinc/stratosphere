import type {ServiceVariation} from "./servicevariation.type";
import type {Staff} from "./staff.type";

export type Appointment = {
  id: number,
  location_id: number
  staff_id: number
  customer_timezone_id: number
  customerable_id: number
  customerable_type: string
  date: string
  start_time: string
  end_time: string
  status?: string
  booking_fee?: number
  tip?: number
  service_total?: number
  tax?: number
  total?: number,
  service_variations: ServiceVariation[],
  staff?: Staff
}
