<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MenuItem extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $with = ['prices'];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public static function scopefilter(Builder $builder, string $tag) {
        return $builder->inRandomOrder()->limit(10);
        // return $builder->whereRelation('tags', 'name', $tag);
    }

    public static function getWithBestSeller() {
        return Self::all();
    }

    public static function getNewlyAdded() {
        return Self::all();
    }
    
    public function toppings() {
        return $this->belongsToMany(Topping::class, 'menu_item_toppings');
    }

    public function prices() {
        return $this->hasMany(MenuItemPrice::class);
    }

    public function category() {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function subcategory() {
        return $this->belongsTo(MenuSubcategory::class, 'menu_subcategory_id');
    }

    public function getImageAttribute($val) : string {
        if(!is_null($val)) {
            return asset('storage/images/menu-items/' . $val);
        }
        return asset('storage/images/default.jpg');
    }
    
    public function offers() {
        return $this->belongsToMany(Offer::class);
    }

    public function bases() {
        return $this->belongsToMany(Base::class);
    }

    public function carts() {
        return $this->belongsToMany(Cart::class);
    }

    public static function booted() {
    static::deleting(function ($menuItem) {
        $menuItem->carts()->detach();
        $menuItem->carts()->delete();
        $menuItem->bases()->detach();
        $menuItem->bases()->delete();
        $menuItem->offers()->detach();
        $menuItem->offers()->delete();
        $menuItem->prices()->delete();
        $menuItem->toppings()->detach();
        $menuItem->toppings()->delete();
    });
}

    
}
