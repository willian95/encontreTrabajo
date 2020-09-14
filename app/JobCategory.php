<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    public function offers(){
        return $this->hasMany(Offer::class);
    }
}
