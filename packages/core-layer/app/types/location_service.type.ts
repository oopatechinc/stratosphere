import type {Service} from "./service.type"


export type LocationService = {
  id?: number,
  location_id: number,
  service_id: number,
  location: Location,
  service: Service
}
