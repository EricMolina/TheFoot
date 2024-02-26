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
    public $manager;

    public function __construct($updatedRestaurant, $oldRestaurant, $manager)
    {
        $this->updatedRestaurant = $updatedRestaurant;
        $this->oldRestaurant = $oldRestaurant;
        $this->manager = $manager;
    }

    public function build()
    {
        return $this->from('thefoot.noreplay@gmail.com', 'TheFoot')
                    ->view('emails.restaurantChanged')
                    ->with([
                        'updatedRestaurant' => $this->updatedRestaurant,
                        'oldRestaurant' => $this->oldRestaurant,
                        'manager' => $this->manager
                    ])
                    ->subject('Restaurante modificado');
    }
}