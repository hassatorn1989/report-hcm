<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_trucker_period extends Model
{
    use HasFactory;
    protected $table = 'view_trucker_period';
    protected $primaryKey = ['idx'];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'year',
        'period',
        'round',
        'routing',
        'trucker',
        'drivingDay',
        'truckerPayAmt',
        'truckerAccount',
        'vendorNo',
        'invoiceNo',
        'createBy',
        'drivingStart',
        'drivingEnd',
        'truckerPayDate',
    ];
}


