<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KaryawanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $email;
    public $password_plain;

    public function __construct($nama, $email, $password_plain,)
    {
        $this->nama = $nama;
        $this->email = $email;
        $this->password_plain = $password_plain;
    }

    public function build()
    {
        return $this->view('emails.karyawan')
                    ->with([
                        'nama' => $this->nama,
                        'email' => $this->email,
                        'password' => $this->password_plain,
                    ]);
    }
}
