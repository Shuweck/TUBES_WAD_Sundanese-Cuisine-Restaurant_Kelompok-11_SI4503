<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;

    // reserve
    public function reserve(){
        return $this->hasMany(Reserve::class, 'table_id', 'id');
    }

}
