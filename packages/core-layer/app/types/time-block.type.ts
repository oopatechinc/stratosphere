import type {TimeBlockDate} from "./time-block-date.type";

export type TimeBlock = {
    id: number,
    staff_id: number,
    time_block_frequency_id: number,
    reason: string,
    is_all_day: boolean,
    starts_at: string,
    ends_at: string
    dates: TimeBlockDate[]
}
