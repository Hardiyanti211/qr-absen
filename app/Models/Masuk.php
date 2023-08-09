<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;
    protected $table = 'masuk';
    protected $primaryKey = 'id_masuk';
    protected $fillable = [
        'id_user',
        'tanggal_masuk',
        'jam_masuk',
    ];
}
