<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemPrice extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $hidden = ['created_at', 'updated_at']; 
    protected $with = ['base:name,id'];
    
    public function base() {
        return $this->belongsTo(Base::class);
    }
}
