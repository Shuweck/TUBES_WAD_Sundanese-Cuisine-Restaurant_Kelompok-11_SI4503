<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    // buat relasi ke tabel makanan
    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    // total subharga
    public function getTotalAttribute(){
        return $this->quantity * $this->menu->price;
    }

}
