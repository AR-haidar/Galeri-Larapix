<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentarfoto';
    protected $fillable = [
        'foto_id',
        'user_id',
        'isi_komentar',
        'parent'
    ];
}
