<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ContactRequestCompleted;
use App\Mail\ContactMail;
use Mail;

class SendContactRequestEmail
{
    /**
     * listenerでeventを受け取り処理を発火させる。この場合だとmailクラス
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ContactRequestCompleted $event)
    {
        $to_address_admin = config('app.accept_mail_address');
        //送信した
        Mail::to($event->user->email)->send(new ContactMail($event->user));
    }
}
