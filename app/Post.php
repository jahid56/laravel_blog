<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model {

    use Notifiable;

    protected $table = "posts";
    protected $primaryKey = 'posts_id';
    protected $fillable = ['posts_users_id', 'posts_track_id', 'topics_track_id', 'posts_title', 'posts_body', 'posts_picture'];
    protected $guarded = ['posts_id'];

}
