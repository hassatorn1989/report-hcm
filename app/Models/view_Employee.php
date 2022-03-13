<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class view_Employee extends Authenticatable
{
    use HasFactory;
    protected $table = 'view_Employee';
    protected $primaryKey = 'empCode';
    protected $keyType = 'string';
    public $incrementing = false;
}
