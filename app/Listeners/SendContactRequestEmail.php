<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ContactRequestCompleted;
use App\Mail\ContactMail;
use Mail;
use Illuminate\Support\Facades\Log;

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
    public function handle($event)
    {
        Log::debug('メール送信開始', ['user' => $event->user->email]);
        //送信した
        Mail::to($event->user->email)->send(new ContactMail($event->user));
        Log::debug('メール送信終了');
    }
}
