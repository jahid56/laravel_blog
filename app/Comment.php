<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model {

    use Notifiable;

    protected $table = "comments";
    protected $primaryKey = 'comments_id';
    protected $fillable = ['comments_users_id', 'comments_track_id', 'comments_title', 'comments_body', 'comments_picture', 'comments_posts_id'];
    protected $guarded = ['comments_id'];

}
