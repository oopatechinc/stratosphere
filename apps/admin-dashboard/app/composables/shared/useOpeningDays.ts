import type {OpeningDay} from "@stratosphere/core-layer/types";

export const useOpeningDays = () => {
    const initialOpeningDays = <OpeningDay[]>[
        {
            id: -1,
            location_id: -1,
            day_of_week: 0,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
        {
            id: -1,
            location_id: -1,
            day_of_week: 1,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
        {
            id: -1,
            location_id: -1,
            day_of_week: 2,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
        {
            id: -1,
            location_id: -1,
            day_of_week: 3,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
        {
            id: -1,
            location_id: -1,
            day_of_week: 4,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
        {
            id: -1,
            location_id: -1,
            day_of_week: 5,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
        {
            id: -1,
            location_id: -1,
            day_of_week: 6,
            is_active: false,
            opening_hours: [
                {
                    opening_day_id: -1,
                    opens_at: '9:00',
                    closes_at: '17:00',
                }
            ]
        },
    ]

    return {initialOpeningDays}
}