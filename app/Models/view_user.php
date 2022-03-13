<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class view_user extends Authenticatable
{
    use HasFactory;
    protected $table = 'view_user';
    protected $primaryKey = 'idx';
}
