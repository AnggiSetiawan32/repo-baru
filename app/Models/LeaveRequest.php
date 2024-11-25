<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use EightyNine\Approvals\Models\ApprovableModel;

class LeaveRequest extends ApprovableModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kelas_id',
        'mahasiswa_id',
        'keterangan',
    ];

    // Fungsi untuk memeriksa apakah permintaan telah disetujui
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
