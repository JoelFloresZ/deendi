<?php

namespace App\Notifications;
 
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
 
class NewMessage extends Notification
{
    use Queueable;
    public $fromUser;
 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->fromUser = $user;
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
        $subject = sprintf('%s: Tienes un mensaje de %s!', config('app.name'), $this->fromUser->name);
        $greeting = sprintf('Hola %s!', $notifiable->name);
 
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->salutation('Saludos de DEENDI')
                ->line('Has recibido este mensaje por que el usuario '.$this->fromUser->name.' lo registro como contacto y le ha enviado un invitación
                     a unirse parte de nuestra plataforma DEENDI.')
                    ->action('IR A DEENDI', url('/'))
                    ->line('Gracias!');
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

