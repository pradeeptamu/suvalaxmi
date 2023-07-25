<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ApartmentHouse extends Model
{
    use HasFactory;

        protected $table="apartment_house";

        protected $fillable=['id','property_id','built_year','no_floors','furnish_status','kitchen',
            'bedroom','bathroom','living_room','parking','amenities'];

        public function property(){
       return $this->belongsTo('App\Models\Property');
        }
}
