<?php

namespace App\Models;

use App\Models\Lembaga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $fillable = [
        'lembaga_id',
        'nis',
        'nama_siswa',
        'email',
        'foto',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
    ];

    public function lembaga(): BelongsTo
    {
        return $this->belongsTo(Lembaga::class);
    }
}
