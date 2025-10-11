<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Application extends Model
{
    protected $fillable = [
        'user_id','contact_email','contact_phone','date_of_birth',
        'gender','country','comments','files'
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
