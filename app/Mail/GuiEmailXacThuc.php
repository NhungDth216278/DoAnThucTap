<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiEmailXacThuc extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $url;

    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Xác thực địa chỉ email của bạn')
            ->view('mail.xac_thuc_email');
    }
}
