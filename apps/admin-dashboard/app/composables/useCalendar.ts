import { ref } from 'vue'
import type {User, Staff} from "#bookisia-shared-module/types"
import type {CalendarEvent} from "vuetify/lib/components/VCalendar/types.js";
import {useStaffsStore} from "#imports";
import {useDayjs} from "#dayjs";
import type { Dayjs } from 'dayjs'
export const useCalendar = async() => {
    const user = useSanctumUser<User>()
    const dayjs = useDayjs()

    interface DateRecord {
        date: string;
    }

    const staffsStore = useStaffsStore()
    const staff = await staffsStore.get(Number(user.value!.staff!.id)) as Staff

    const calendarEvents = ref<CalendarEvent[]>([])

    createTimeBlockEvents()
    createAppointmentEvents()

    function createAppointmentEvents() {
        staff?.appointments?.forEach(appointment => {
            const startString = dayjs(`${appointment.date} ${appointment.start_time}`).format('YYYY-MM-DD HH:mm')
            const endString = dayjs(`${appointment.date} ${appointment.end_time}`).format('YYYY-MM-DD HH:mm')

            calendarEvents.value.push({
                eventId: appointment.id,
                name: 'Appointment',
                start: startString,
                end: endString,
                color: 'green',
            });

        })
    }

    function createTimeBlockEvents() {
        staff?.time_blocks?.forEach(timeBlock => {
            const sortedMoments: Dayjs[] = timeBlock.dates
                .map((d: DateRecord) => dayjs(d.date))
                .sort((a, b) => a.valueOf() - b.valueOf());

            if (sortedMoments.length === 0) return [];

            let rangeStart: Dayjs = sortedMoments[0]!;
            let rangeEnd: Dayjs = sortedMoments[0]!;

            for (let i = 1; i <= sortedMoments.length; i++) {
                const current: Dayjs | undefined = sortedMoments[i];

                // Check if 'current' is exactly 1 day after 'rangeEnd'
                if (current && current.isSame(dayjs(rangeEnd).add(1, 'days'), 'day') && timeBlock.is_all_day) {
                    rangeEnd = current;
                } else {
                    // 2. Format the block strings
                    const startStr = rangeStart.format('YYYY-MM-DD');
                    const endStr = rangeEnd.format('YYYY-MM-DD');

                    calendarEvents.value.push({
                        timeBlockId: timeBlock.id,
                        name: timeBlock.reason || 'Time Block',
                        start: timeBlock.is_all_day
                            ? startStr
                            : `${startStr} ${timeBlock.starts_at}`,
                        end: timeBlock.is_all_day
                            ? endStr
                            : `${endStr} ${timeBlock.ends_at}`,
                        allDay: timeBlock.is_all_day,
                        color: 'grey',
                    });

                    // 3. Reset for the next sequence
                    if (current) {
                        rangeStart = current;
                        rangeEnd = current;
                    }
                }
            }
        })
    }

    function handleEventClick(eventId: number) {
        // if (timeBlockId == -1) {
        //   currentTimeBlock.value = initialTimeBlock
        // } else {
        //   currentTimeBlock.value = timeBlocks.value!.find(tb => tb.id == timeBlockId)
        // }
        //
        // showTimeBlockDialog.value = true
    }

    return {calendarEvents, handleEventClick}
}