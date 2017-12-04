<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    //

//    const TYPE_IMAGE = 1, TYPE_VIDEO = 2;

    protected $fillable = [

        'id',
        'resource_url',
        'resource_basename',
        'resource_type',
        'width',
        'height'

    ];
}
