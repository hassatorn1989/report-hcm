<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbc_JV_Payroll_period extends Model
{
    use HasFactory;
    protected $table = 'tbc_JV_Payroll_period';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
}
