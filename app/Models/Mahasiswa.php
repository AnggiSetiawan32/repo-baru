<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kelas_id',
        'nim',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'edit',
    ];
    public function requestEdits()
        {
            return $this->hasMany(Request::class);
        }
    public function kelas()
        {
            return $this->belongsTo(Kelas::class);
        }
    public function request()
        {
            return $this->belongsTo(Request::class);
        }
  


}
