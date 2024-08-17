<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table = 'foto';

    protected $fillable = [
        "judul_foto",
        "deskripsi_foto",
        "lokasi_file",
        "album_id",
        "user_id",
    ];

    protected $dates = ['created_at', 'updated_at'];
}
