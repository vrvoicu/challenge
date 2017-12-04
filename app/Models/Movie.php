<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [

        'id',
        'info'

    ];

    protected $casts = [
        'info' => 'array',
    ];

//    public function getInfoAttribute($value){
//
//        var_dump("aaaa");
//        var_dump($value);
//        exit();
//
//        return json_decode($this->attributes['info']);
//    }
}
