<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Models;

class RoleModuls extends Model
{
    protected $fillable = [
        'id',
        'role_id',
        'moduls_id',
        'access',
        'create',
        'update',
        'delete'
    ];
}
