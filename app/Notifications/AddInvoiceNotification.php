<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AddInvoiceNotification extends Notification
{
    use Queueable;
    private $invoice_id;

    /**
     * Create a new notification instance.
     */
    public function __construct( $invoice_id)
    {
        $this->invoice_id = $invoice_id;
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


    public function ToDataBase($notifiable)
    {
        return [

            // 'data' => $this->details['body'],
            'id' => $this->invoice_id,
            'title' => 'there is an invoice was added by: ',
            'user' => Auth::user()->name,
        ];
    }
}
