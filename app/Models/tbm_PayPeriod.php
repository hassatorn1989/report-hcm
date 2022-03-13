<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_PayPeriod extends Model
{
    use HasFactory;
    protected $table = 'tbm_PayPeriod';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'year',
        'period',
        'round',
        'periodStart',
        'periodEnd',
        'periodPay',
        'periodFlag',
        'createBy',
    ];
}
