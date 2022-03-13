<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbm_Employee extends Model
{
    use HasFactory;
    protected $table = 'tbm_Employee';
    protected $primaryKey = ['orgCopCode', 'empCode'];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'orgCopCode',
        'createBy',
        'nationality',
        'pregnantFlag',
        'religion',
        'busRate',
        'paymentBank',
        'positinCode',
        'levelCode',
        'empStatus',
        'sex',
        'dateEx',
        'dateSt',
        'dateFr',
        'birthDate',
        'mobile',
        'SSNO',
        'IDCard',
        'postCode',
        'addressLine3',
        'addressLine2',
        'addressLine1',
        'orgLineCode',
        'orgJobCode',
        'orgDepCode',
        'orgDivCode',
        'lastNameTH',
        'firstNameTH',
        'titleNameTH',
        'lastNameEN',
        'firstNameEN',
        'titleNameEN',
        'empCode',
        'createBy',
    ];
}
