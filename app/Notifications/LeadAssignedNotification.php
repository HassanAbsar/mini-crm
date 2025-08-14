<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeadAssignedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Lead $lead)
    {
         $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('The New Lead Assigned')
                     ->line('A new lead has been assigned to you.')
                    ->line('Name: ' . $this->lead->name)
                    ->line('Email: ' . $this->lead->email)
                    ->line('Phone: ' . $this->lead->phone)
                    ->action('View Lead', url(route('leads.show', $this->lead->id)));
    }

    public function toDatabase($notifiable)
    {
        return [
            'lead_id' => $this->lead->id,
            'name' => $this->lead->name,
            'message' => 'A new lead has been assigned to you.'
        ];
    }


}
