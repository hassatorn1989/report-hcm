<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_MapAccount extends Model
{
    use HasFactory;
    protected $table = 'tbm_MapAccount';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'orgCopCode',
        'orgDivCode',
        'orgDepCode',
        'orgJobCode',
        'orgLineCode',
        'accountType',
        'accountTypeName',
        'company',
        'costCenter',
        'accountCode',
        'ioNumber',
        'createBy',
    ];
}
