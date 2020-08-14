<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = "communes";

    public function user(){
        return $this->hasMany(User::class);
    }

}
