<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_TimeWorking_hour_preparation extends Model
{
    use HasFactory;
    protected $table = 'view_TimeWorking_hour_preparation';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
}
