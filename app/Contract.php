<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

}
