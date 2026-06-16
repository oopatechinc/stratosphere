export type OpeningHourException = {
  id: number,
  location_id: number,
  specific_date: string,
  opens_at?: string,
  closes_at?: string,
  reason: string
}
