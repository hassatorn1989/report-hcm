<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbt_TimeWorking_hour extends Model
{
    use HasFactory;
    protected $table = 'tbt_TimeWorking_hour';
    protected $primaryKey = ['orgCopCode', 'empCode', 'shiftType', 'dateIn'];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'orgCopCode',
        'empCode',
        'accountType',
        'shiftType',
        'dateIn',
        'timeIn',
        'dateOut',
        'timeOut',
        'workHour',
        'createBy',
    ];
}
