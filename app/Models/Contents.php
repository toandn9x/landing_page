<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;
    protected $table = 'contents';
    public function menus()
    {
        return $this->belongsTo(Menus::class, 'id_menu', 'id');
    }
}
