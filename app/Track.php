<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model {

    public function randomNumber($min = 5, $max = 15) {
        $length = rand($min, $max);
        $string = '';
        $index = '0123456789abcdefghijklmnopqrstuvwxyzJAHidmAhMUdDABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i++) {
            $string .= $index[rand(0, strlen($index) - 1)];
        }
        return $string;
    }

}
