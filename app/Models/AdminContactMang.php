<?php

namespace App\Models;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class AdminContactMang extends Model
{
       use Loggable;

    protected $fillable = [
        'company_id',
        'software_name',
        'contact_email',
        'phone',
        'address',
        'website',
        'business_hours',
        'emergency_contact',
    ];


}