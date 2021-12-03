<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from(config('app.mail_from_address')) // 送信元のメールアドレスを指定
        ->subject('登録完了のお知らせ') // メールの件名
        ->view('emails.contact_mail') // どのテンプレートを呼び出すか
        ->with(['user' => $this->user]); // withオプションでセットしたデータをテンプレートへ受け渡す
    }
}
