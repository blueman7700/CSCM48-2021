<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Post;

class UserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user_from;
    public $user_to;
    public $post;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user, string $content)
    {
        //
        $this->user_from = $user;
        $this->post = $post;
        $this->content = $content;

        $this->user_to = $post->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notifier@coredump.com')->view('emails.commented');
    }
}
