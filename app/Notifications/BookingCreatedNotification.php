<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class BookingCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $booking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->booking->user && $this->booking->user->name ? $this->booking->user->name : ($this->booking->guest_name ?? 'Guest');
        $email = $this->booking->user && $this->booking->user->email ? $this->booking->user->email : ($this->booking->guest_email ?? '');
        $phone = $this->booking->guest_phone ?? ($this->booking->user && $this->booking->user->phone ? $this->booking->user->phone : '');
        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->greeting('Hello ' . $name . ',')
            ->line('Your booking for the tour "' . $this->booking->tour->title . '" has been received.')
            ->line('Booking Date: ' . $this->booking->booking_date)
            ->line('Guests: ' . $this->booking->guests)
            ->line('Total Price: $' . $this->booking->total_price)
            ->line('Phone: ' . $phone)
            ->line('Email: ' . $email)
            ->action('View Booking', url('/'))
            ->line('Thank you for booking with us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
