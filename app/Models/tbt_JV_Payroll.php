<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbt_JV_Payroll extends Model
{
    use HasFactory;
    protected $table = 'tbt_JV_Payroll';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'orgCopCode',
        'orgDivCode',
        'orgDepCode',
        'costCenter',
        'accountCode',
        'payrollDate',
        'docNumber',
        // 'amtEmp',
        'amtWage',
        'amtHour',
        'jvReferance',
        'createBy',
    ];
}
