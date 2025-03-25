<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification {
    use Queueable;
    public Booking $booking;
    public string $message;

    /**
     * Create a new notification instance.
     *
     * @param Booking $booking
     * @param string $message
     */
    public function __construct(Booking $booking, string $message) {
        $this->booking = $booking;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array {
        return [
            'message'    => $this->message,
            'booking_id' => $this->booking->id,
        ];
    }
}
