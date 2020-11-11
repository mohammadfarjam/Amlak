<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_photo extends Model
{
    /**
     * @var mixed
     */
    private $user_id;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
