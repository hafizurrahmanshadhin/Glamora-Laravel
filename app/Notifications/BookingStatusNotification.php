<?php
namespace App\Notifications;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification {
    use Queueable;
    public $booking;
    public $message;

    public function __construct(Booking $booking, string $message) {
        $this->booking = $booking;
        $this->message = $message;
    }

    public function via($notifiable) {
        return ['database'];
    }

    public function toArray($notifiable) {
        return [
            'message'    => $this->message,
            'booking_id' => $this->booking->id,
        ];
    }
}
