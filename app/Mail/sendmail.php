<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class sendmail extends Mailable
{
use Queueable, SerializesModels;
public $details;
/**
* Create a new message instance.
*
* @return void
*/
public function __construct($details)
{
$this->details = $details;
}
/**
* Build the message.
*
* @return $this
*/
public function build()
{
// return $this->subject('Mail from Nicesnippets.com')
// ->view('form');
//return $this->from('amanofc@gmail.com')->subject('New passcode')->view('update')->with('details', $this->details);

}
}