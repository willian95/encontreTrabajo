<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{

    use SoftDeletes;
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(JobCategory::class);
    }

    public function views(){
        return $this->hasMany(OfferViewer::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function commune(){
        return $this->belongsTo(Commune::class);
    }
    
}
