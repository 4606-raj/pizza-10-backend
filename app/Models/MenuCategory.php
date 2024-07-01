<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function menuItems() {
        return $this->hasMany(MenuItem::class, 'menu_categories_id');
    }

    public function getImageAttribute($val) : string {
        if(!is_null($val)) {
            return asset('storage/images/menu-categories/' . $val);
        }
        return asset('storage/images/default.jpg');
    }
}
