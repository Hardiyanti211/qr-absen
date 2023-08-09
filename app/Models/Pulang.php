<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pulang extends Model
{
    use HasFactory;
    protected $table = 'pulang';
    protected $primaryKey = 'id_pulang';
    protected $fillable = [
        'id_user',
        'tanggal_pulang',
        'jam_pulang',
    ];
}
