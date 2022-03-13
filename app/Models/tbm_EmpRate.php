<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_EmpRate extends Model
{
    use HasFactory;
    protected $table = 'tbm_EmpRate';
    protected $primaryKey = ['orgCopCode', 'empCode'];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'orgCopCode',
        'empCode',
        'empRate',
        'createBy',
    ];
}
