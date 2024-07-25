<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToppingCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function toppings() {
        return $this->hasMany(Topping::class);
    }

    public function prices() {
        return $this->hasMany(ToppingCategoryPrice::class);
    }
    
}
