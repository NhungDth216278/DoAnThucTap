<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DatKhamThanhCong extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $benhNhan;
    public $bacSi;
    public $lichHen;

    public function __construct($user, $benhNhan, $bacSi, $lichHen)
    {
        $this->user = $user;
        $this->benhNhan = $benhNhan;
        $this->bacSi = $bacSi;
        $this->lichHen = $lichHen;
    }

    public function build()
    {
        return $this->subject('Cảm ơn bạn đã đặt khám bệnh tại EbooCare')
        ->view('mail.dat_kham_thanh_cong');
    }
}
