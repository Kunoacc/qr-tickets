<?php

namespace App;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use GeneratesUuid;

    protected $fillable = [
        'name', 'email'
    ];
    //
}
