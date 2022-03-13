<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_OrgUnit extends Model
{
    use HasFactory;
    protected $table = 'tbm_OrgUnit';
    protected $primaryKey = ['OrgCopCode', 'OrgDivCode', 'OrgDepCode'];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['orgCopCode', 'orgDivCode', 'orgDepCode', 'orgUnitNameEN', 'orgUnitNameTH', 'orgTypeCode', 'orgTypeName', 'createBy'];
}
