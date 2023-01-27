<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LikeNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public User $user, public Post $post)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'post_id'   => $this->post->id,
            'user_id'   => $this->user->id,
            'user_name'   => $this->user->name,
            'post_title'   => $this->post->title,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $notification = [
            "data" => [
                "user_name" => $this->user->name,
                "post_title" => $this->post->title,
            ]
        ];

        return new BroadcastMessage([
            'notification' => $notification
        ]);
    }
}
