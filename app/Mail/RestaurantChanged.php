<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RestaurantChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $updatedRestaurant;
    public $oldRestaurant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($updatedRestaurant, $oldRestaurant)
    {
        $this->updatedRestaurant = $updatedRestaurant;
        $this->oldRestaurant = $oldRestaurant;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Restaurant Changed',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        /*return new Content(
            view: 'emails.restaurantChanged',
            data: [
                'updatedRestaurant' => $this->updatedRestaurant,
                'oldRestaurant' => $this->oldRestaurant,
            ],
        );*/
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
    {
        return $this->view('emails.restaurantChanged')
                    ->with([
                        'updatedRestaurant' => $this->updatedRestaurant,
                        'oldRestaurant' => $this->oldRestaurant,
                    ])
                    ->subject('Se ha modificado un restaurante :o');
    }
}