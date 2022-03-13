<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_IncomeDeduct extends Model
{
    use HasFactory;
    protected $table = 'tbm_IncomeDeduct';
    protected $primaryKey = 'IncomeDeductCode';
    protected $keyType = 'string';
    public $incrementing = false;
}
