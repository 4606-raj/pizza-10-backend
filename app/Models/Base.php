<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function menuItems() {
        return $this->belongsToMany(MenuItem::class);
    }
}
