<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function offers() {
        return $this->hasMany(Offer::class);
    }
}
