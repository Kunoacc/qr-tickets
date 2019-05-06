<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    public function data(){
        return $this->belongsTo(Data::class, 'data_id');
    }
    //
}
