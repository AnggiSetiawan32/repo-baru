<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas_id',
        'mahasiswa_id',
        'keterangan',
    ];
    public function updateMahasiswaData(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);

        // Decode data yang ingin diubah
        $requestedData = json_decode($request->requested, true);

        // Update data mahasiswa
        $mahasiswa->update($request);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

}
