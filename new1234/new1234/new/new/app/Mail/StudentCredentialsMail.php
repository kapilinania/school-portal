<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $password;

    public function __construct($student, $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.student_credentials')
                    ->subject('Your Student Account Credentials')
                    ->with([
                        'student' => $this->student,
                        'password' => $this->password,
                        'admission_no' => $this->student->admission_no,
                    ]);
    }
}
