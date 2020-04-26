<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreReceiveNewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    //por onde vou enviar as notificações
    public function via($notifiable)
    {
        //adiciona canais, no caso a notificação será enviado para database e email
        return ['database', 'mail'];
    }

    //com o mail em cima terá a ativação desse metodo
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Você recebeu um novo pedido!')
                    ->greeting('Olá vendedor, tudo bem?')
                    ->line('Você recebeu um novo pedido na loja!')
                    ->action('Ver pedidos', route('admin.orders.my'));
                    
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
            'message' => 'Você tem um novo pedido solicitado'
        ];
    }

   
}
