<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuiLinkKhoiPhucMatKhau extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        $resetLink = url('/khoi-phuc-mat-khau?token=' . $this->token . '&email=' . urlencode($this->email)); // hoặc dùng route nếu có đặt tên route

        return $this->subject('Khôi phục mật khẩu của bạn từ Hệ thống quản lý Đặt Lịch Khám - EbookCare')
                    ->view('mail.gui_link_khoi_phuc_mat_khau')
                    ->with([
                        'link' => $resetLink,
                    ]);
    }
}
