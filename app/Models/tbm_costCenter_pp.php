<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_costCenter_pp extends Model
{
    use HasFactory;
    protected $table = 'tbm_costCenter_pp';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
}
