<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification {
    use Queueable;
    public Booking $booking;

    public function __construct(Booking $booking) {
        $booking->load('userService.service', 'user');
        $this->booking = $booking;
    }

    public function via($notifiable): array {
        return ['database'];
    }

    public function toArray($notifiable): array {
        $serviceName = $this->booking->userService->service->services_name ?? 'Service';
        $clientName  = trim($this->booking->user->first_name . ' ' . $this->booking->user->last_name) ?: 'Client';
        $date        = date('l, F jS, Y', strtotime($this->booking->appointment_date));
        $time        = date('h:i A', strtotime($this->booking->appointment_time));
        $price       = number_format($this->booking->price, 2);

        return [
            'message'          => "New booking by $clientName on $date at $time for \$$price.",
            'booking_id'       => $this->booking->id,
            'service_name'     => $serviceName,
            'client_name'      => $clientName,
            'appointment_date' => $this->booking->appointment_date,
            'appointment_time' => $this->booking->appointment_time,
            'price'            => $this->booking->price,
        ];
    }
}
