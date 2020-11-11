<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $upload='/storage/photos/';

    public function getPathAttribute($photo)
    {
        return $this->upload.$photo;
    }
}
