<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbc_JV_Transfer_daily extends Model
{
    use HasFactory;
    protected $table = 'tbc_JV_Transfer_daily';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
}
