<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RestaurantAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;
    public $manager;

    public function __construct($restaurant, $manager)
    {
        $this->restaurant = $restaurant;
        $this->manager = $manager;
    }

    public function build()
    {
        return $this->from('thefoot.noreplay@gmail.com', 'TheFoot')
                    ->view('emails.restaurantAccepted')
                    ->with([
                        'restaurant' => $this->restaurant,
                        'manager' => $this->manager
                    ])
                    ->subject('Su restaurante "' . $this->restaurant->name . '" ha sido aceptado!');
    }
}