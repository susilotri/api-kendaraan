<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = "kendaraan";
    protected $fillable = [
        "tahun",
        "warna",
        "harga",
        "stock",
        "type",
        "kendaraan",
        "kendaraan_type",
        "qty"
    ];
}
