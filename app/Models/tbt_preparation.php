<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbt_preparation extends Model
{
    use HasFactory;
    protected $table = 'tbt_preparation';
    protected $primaryKey = 'idx';
    protected $keyType = 'string';
    public $incrementing = false;
}
