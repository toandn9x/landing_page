<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = 'menus';
    public function contents()
    {
        return $this->hasMany(Contents::class, 'id_menu','id');
    }
}
