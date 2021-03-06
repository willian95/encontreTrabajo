<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAgeAttribute() {
        return $this->birth_date->diffInYears(\Carbon\Carbon::now());
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
