<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userfavorite extends Model
{

    protected $fillable=['id','user_id','prop_id'];
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }
}
