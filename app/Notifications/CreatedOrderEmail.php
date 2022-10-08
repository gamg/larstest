<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedOrderEmail extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
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
        return (new MailMessage)
                ->subject('Nueva Orden Creada')
                ->greeting('Hola que tal!')
                ->line('Se ha creado correctamente una nueva orden.')
                ->line('Orden #'.$this->order->id)
                ->line('Total: '.$this->order->total.'$')
                ->line('Total impuestos: '.$this->order->total_tax.'$')
                ->line('Total + Impuestos: '.$this->order->total_with_tax.'$')
                ->action('Más información', route('orders.show', [$this->order->id]))
                ->salutation('Gracias de antemano');
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
