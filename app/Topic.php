<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Topic extends Model {

    use Notifiable;

    protected $table = "topics";
    protected $primaryKey = 'id';
    protected $fillable = ['topics_name', 'topics_track_id', 'topics_name'];
    protected $guarded = ['id'];

}
