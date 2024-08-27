<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenuItem extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function price() {
        return $this->belongsTo(MenuItemPrice::class, 'menu_item_price_id');
    }

    public function menuItem() {
        return $this->belongsTo(MenuItem::class)->without('prices');
    }
    
}
