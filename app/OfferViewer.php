<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferViewer extends Model
{
    public function view(){
        return $this->belongsTo(Offer::class);
    }
}
