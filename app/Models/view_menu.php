<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_menu extends Model
{
    use HasFactory;
    protected $table = 'view_menu';
    protected $primaryKey = 'id';

    public function get_sub_menu()
    {
        return $this->hasMany(view_sub_menu::class, 'parent_id', 'id')->orderBy('id', 'asc');
    }
}
