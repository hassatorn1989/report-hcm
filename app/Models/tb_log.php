<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_log extends Model
{
    use HasFactory;
    protected $table = 'tb_log';
    protected $primaryKey = 'id';
}
