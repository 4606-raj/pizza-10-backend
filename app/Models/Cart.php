<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function menuItem() {
        return $this->belongsTo(MenuItem::class);
    }

    public function base() {
        return $this->belongsTo(Base::class);
    }
}
