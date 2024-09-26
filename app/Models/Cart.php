<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function menuItems() {
        return $this->belongsToMany(MenuItem::class);
    }

    public function base() {
        return $this->belongsTo(Base::class);
    }

    public function menuItemPrice() {
        return $this->belongsTo(MenuItemPrice::class, 'menu_item_id', 'menu_item_id')->whereBaseId($this->base_id);
    }

    function toppings() {
        return $this->hasMany(CartAddon::class)->whereAddonType('topping');
    }
}
