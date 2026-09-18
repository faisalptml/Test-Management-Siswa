<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Lembaga extends Model
{
    protected $fillable = [
        'nama_lembaga',
        'alamat',
        'telepon',
        'email',
    ];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
