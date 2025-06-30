<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;
    public $password;

    public function __construct($teacher, $password)
    {
        $this->teacher = $teacher;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.teacher_credentials')
                    ->subject('Your Teacher Account Credentials')
                    ->with([
                        'teacher' => $this->teacher,
                        'password' => $this->password,
                        'teacher_id' => $this->teacher->teacher_id,
                    ]);
    }
}
