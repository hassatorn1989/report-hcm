<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbt_EmpLeave extends Model
{
    use HasFactory;
    protected $table = 'tbt_EmpLeave';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'transferDate',
        'orgCopCode',
        'orgDivCode',
        'orgDepCode',
        'empCode',
        'year',
        'period',
        'round',
        'accountType',
        'leaveHour',
        'leaveAmount',
        'createBy',
    ];
}
