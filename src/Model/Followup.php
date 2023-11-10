<?php

namespace App\Model;

enum Followup
{
    case Todo;
    case Done;

    public function label($type){

        return match($this){
            self::Todo => $type == 'Movie' ? 'To see' : 'To read',
            self::Done => $type == 'Movie' ? 'Watched' : 'Read'
        };
    }
}
