import type {OpeningHour} from "./opening-hour.type";

export type OpeningDay = {
  id: number,
  location_id: number,
  day_of_week: number,
  is_active: boolean,
  opening_hours: OpeningHour[]
}
