<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = 'album';

    // protected $fillable = ['nama_album','deskripsi_album'];
    protected $dates = ['created_at', 'updated_at'];

}
