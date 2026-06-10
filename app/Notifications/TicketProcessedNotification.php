<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TicketProcessedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Ticket $ticket
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket processado com sucesso')
            ->greeting('Olá!')
            ->line("Seu ticket #{$this->ticket->id} foi processado com sucesso.")
            ->line('Os dados técnicos foram atualizados.')
            ->action('Ver Ticket', url('/tickets/' . $this->ticket->id))
            ->line('Obrigado por usar o ServiceHub!');
    }
}
