<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photo";
    protected $primaryKey = "idphoto";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'deleted', 'created_at', 'updated_at'
    ];
}
