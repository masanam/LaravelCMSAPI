<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class saveContact extends Mailable
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
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->title = $data['title'];
        $this->content = $data['content'];
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
                   ->subject('Contact Us')
                   ->view('emails.saveContact')
                   ->with(
                    [
                        'name' => $this->name,
                        'email' => $this->email,
                        'title' => $this->title,
                        'content' => $this->content,

                    ]);
    }
}
