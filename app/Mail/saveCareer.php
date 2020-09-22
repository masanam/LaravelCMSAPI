<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class saveCareer extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->firstname = $data['firstname'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->address = $data['address'];
        $this->resume = $data['resume'];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->view('emails.ActivationUser');
    // }

        /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@kino.co.id','PT. Kino Indonesia')
                   ->subject('Karir - Pendaftaran')
                   ->view('emails.saveCareer')
                   ->with(
                    [
                        'firstname' => $this->firstname,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'address' => $this->address,
                    ])->attach($this->resume, [
                        'as' => 'Resume',
                        'mime' => 'application/pdf',
                    ]);
    }
}
