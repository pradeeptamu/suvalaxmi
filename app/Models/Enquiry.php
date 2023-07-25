<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table= "enquiries";

    protected $fillable = [
        'name', 'email', 'mobile_number','message','property_id','owner_id'
    ];

}
