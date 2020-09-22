<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class saveInvestor extends Mailable
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
        $this->phone = $data['phone'];
        $this->country = $data['country'];
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
                   ->subject('Investor Contact')
                   ->view('emails.saveInvestor')
                   ->with(
                    [
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'country' => $this->country,
                        'title' => $this->title,
                        'content' => $this->content,

                    ]);
    }
}
