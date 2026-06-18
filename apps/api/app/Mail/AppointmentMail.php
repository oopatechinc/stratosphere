<?php

namespace App\Mail;

use App\Listeners\ProcessAppointmentMails\SendAppointmentMails\AppointmentMailPayload;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    private Calendar $calendar;
    private Collection $videoConferenceIntegrationEvents;

    const VIEW_APPOINTMENT_CREATED = 'emails.appointment.created';
    const VIEW_APPOINTMENT_UPDATED = 'emails.appointment.updated';
    const VIEW_APPOINTMENT_DELETED = 'emails.appointment.deleted';

    public function __construct(
        private readonly Appointment                    $appointment,
        private readonly AppointmentMailPayload $appointmentMailPayload,
        private readonly string                         $mailView,
    ){}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $payload = $this->appointmentMailPayload->getMergedPayload();
        if (!empty($this->videoConferenceIntegrationEvents)) {
            $payload = array_merge($payload, ['videoConferenceIntegrationEvents' => $this->videoConferenceIntegrationEvents]);
        }

        $appointmentCreatedMail = $this->markdown($this->mailView)->with($payload);
        if (!empty($this->calendar)) {
            $appointmentCreatedMail->attachData($this->calendar->get(), 'appointment.ics', [
                'mime' => 'text/calendar; charset=UTF-8; method=REQUEST',
            ]);
        }

        return $appointmentCreatedMail;
    }

    public function setCalendar(Calendar $calendar): void
    {
        $this->calendar = $calendar;
    }

    public function setVideoConferenceIntegrationEvents(Collection $events): void
    {
        $this->videoConferenceIntegrationEvents = $events;
    }
}
