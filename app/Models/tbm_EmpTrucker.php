<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_EmpTrucker extends Model
{
    use HasFactory;
    protected $table = 'tbm_EmpTrucker';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'empCode',
        'routeFee',
        'routing',
        'createBy',
    ];
}
