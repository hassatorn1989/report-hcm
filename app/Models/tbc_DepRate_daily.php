<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbc_DepRate_daily extends Model
{
    use HasFactory;
    protected $table = 'tbc_DepRate_daily';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
}
