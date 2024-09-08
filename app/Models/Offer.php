<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $hidden = ['created_at', 'updated_at'];

    public function getImageAttribute($val) : string {
        if(!is_null($val)) {
            return asset('storage/images/offers/' . $val);
        }
        return asset('storage/images/default.jpg');
    }

    public function offerType() {
        return $this->belongsTo(OfferType::class);
    }

    public function offerCategory() {
        return $this->belongsTo(OfferType::class);
    }

    public function menuItems() {
        return $this->belongsToMany(MenuItem::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
