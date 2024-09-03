<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Staff extends Model implements AuthenticatableContract
{
    
    use Authenticatable;

    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function getRoleBadgeAttribute() {
        $roles = [
            '<span class="badge badge-dark">Kitchen Saff</span>',
            '<span class="badge badge-dark">Delivery Staff</span>',
        ];

        return isset($roles[$this->role - 2])? $roles[$this->role - 2]: '--';
    }
}
