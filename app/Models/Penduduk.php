<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'noKK',
        'nik',
        'nama',
        'tempatLahir',
        'tanggalLahir',
        'jenisKelamin',
        'pekerjaan',
        'kategori',
        'statusPerkawinan',
        'alamat',
        'rt',
        'rw',
        'noRumah',
        'ibu_hamil',
        'ibu_menyusui',
        'berkebutuhan_khusus',
        'keterangan_khusus',
    ];

    protected $casts = [
        'tanggalLahir' => 'date'
    ];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(KK::class, 'noKK', 'noKK');
    }
}
