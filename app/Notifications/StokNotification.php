<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StokNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $stok_cost;
    public $stok_code;
    public $buy_price;
    public $message;
    public function __construct($stok_cost, $stok_code ,$buy_price ,$message)
    {
        $this->stok_cost=$stok_cost;
        $this->stok_code=$stok_code;
        $this->buy_price =$buy_price;
        $this->message =$message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "stok_name"=> $this->stok_cost,
            "stok_code"=>$this->stok_code,
            "buy_price"=> $this->buy_price,
            "message"=>  $this->message,
        ];
    }
}

