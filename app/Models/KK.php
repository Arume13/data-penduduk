<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    use HasFactory;

    protected $table = 'kk';

    protected $fillable = [
        'noKK',
        'kepalaKeluarga',
        'alamat',
        'rt',
        'rw',
        'noRumah',
    ];

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'noKK', 'noKK');
    }
}

