<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // public function cartItems() {
    //     return $this->belongsToMany(Cart::class);
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function menuItems() {
        return $this->hasMany(OrderMenuItem::class);
    }

    public function Address() {
        return $this->belongsTo(Address::class);
    }

    public function getStatusBadgeAttribute() {
        $statuses = [
            '<span class="badge badge-danger">Confirmed</span>',
            '<span class="badge badge-warning">Preparing</span>',
            '<span class="badge badge-info">Prepared</span>',
            '<span class="badge badge-primary">Picked Up</span>',
            '<span class="badge badge-success">Delivered</span>',
        ];

        return isset($statuses[$this->status - 2])? $statuses[$this->status - 2]: '--';
    }
}
