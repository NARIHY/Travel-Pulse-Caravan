<?php

namespace App\Notifications;

use App\Models\Car;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TripChangingNotification extends Notification
{


    /**
     * Create a new notification instance.
     */
    public function __construct(public Trip $trip)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $trip = $this->trip;

        $dateDepart = Carbon::parse($trip->date_depart);
        $heureDepart = Carbon::parse($trip->heure_depart);

        // Formatez la date et l'heure comme vous le souhaitez
        $date = $dateDepart->format('d-m-Y'); // Par exemple, '2023-10-04'
        $heure = $heureDepart->format('H:i:s');
        $car = Car::findOrFail($trip->car);
        return (new MailMessage)
                ->subject('Mis à jour de la reservation')
                ->greeting('Bonjour/Bonsoir,')
                ->line('Cher passager,')
                ->line('Nous tenons à vous informer que le trajet que vous avez réservé a été modifié.')
                ->line('Voici les détails de la modification :')
                ->line('Voiture : '. $car->plate_number)
                ->line('Trajet:' . $trip->place_depart. '-' . $trip->place_arrivals)
                ->line('Date et heure de départ : '. $date.' ' . $heure)
                ->line('Ne vous inquittiez pas, même s\'il y a eu des modification, votre ticket de réservation reste toujours utilisable.')
                ->line('Nous vous remercions pour votre compréhension et votre utilisation de notre service.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
