<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Keranjang extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'keranjang';
    protected $fillable = [
        'user_id',
        'foto',
        'judul_foto',
        'deskripsi_foto',
    ];

}
