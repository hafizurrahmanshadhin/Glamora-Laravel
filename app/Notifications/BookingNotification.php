<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification {
    use Queueable;
    public $booking;

    public function __construct(Booking $booking) {
        $this->booking = $booking;
    }

    public function via($notifiable) {
        return ['database'];
    }

    public function toArray($notifiable) {
        return [
            'message'          => 'New booking created by a client',
            'booking_id'       => $this->booking->id,
            'user_service_id'  => $this->booking->user_service_id,
            'service_type'     => $this->booking->service_type,
            'appointment_date' => $this->booking->appointment_date,
            'appointment_time' => $this->booking->appointment_time,
        ];
    }
}
