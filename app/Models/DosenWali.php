<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenWali extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kelas_id',
        'kode_dosen',
        'nip',
        'name'
    ];
    public function requestEdits()
    {
        return $this->hasMany(Request::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id'); // Pastikan nama relasi dan foreign key benar
    }

}
