<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $table="properties";
    protected $fillable=['id','purpose','type','category','address','location','road','images','thumbnail','title','description','area_total'
        ,'area_built','face','road_size','road_type','price','price_unit','owner_id','status'];

    public function apartment_house()
    {
        return $this->hasOne('App\Models\Apartment_House');
    }
    public function favoriteProperty()
    {
        return $this->hasMany('App\Models\Userfavorite');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

}
