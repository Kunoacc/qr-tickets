<?php

namespace App\Mail;

use App\Data;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventSent extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->data = $data;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.event.sent')
            ->with([
                'email' => $this->data->email,
                'name' => $this->data->name,
                'message' => new Message(new \Swift_Message())
            ])->from('affdisrupt2019@africafintechfoundry.com')->attachData(
                QrCode::format('png')->size('400')->generate($this->data->uuid), 'qr.png', [
                    'mime' => 'image/png'
                ]
            )->subject('Disrupt 2019 QR Code');
    }
}
