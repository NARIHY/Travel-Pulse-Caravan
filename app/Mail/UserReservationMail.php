<?php

namespace App\Mail;

use App\Models\Passenger;
use App\Models\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( public string $reservationId)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Reservation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $reservation = \App\Models\Reservation::findOrFail($this->reservationId);
        $qrCode = QrCode::size(175)
                        ->color(200, 150, 0)
                        ->generate($reservation->identification);

        $trip = Trip::findOrFail($reservation->trip_id);
        $passenger = Passenger::findOrFail($reservation->passenger_id);
        $pdfLink = 'pdf/reservation_'.$reservation->id.'_'.$passenger->id.'.pdf';

        return new Content(
            view: 'email.userreservation',
            with: ['passenger' => $passenger,
                    'trip' => $trip,
                    'qrCode' => $qrCode,
                    'reservation' => $reservation
                ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

       // $reservation = \App\Models\Reservation::findOrFail($this->reservationId);

       // $passenger = Passenger::findOrFail($reservation->passenger_id);


        return [
            //Attachment::fromStorageDisk('public', 'pdf/reservation_'.$reservation->id.'_'.$passenger->id.'.pdf')
        ];
    }
}
