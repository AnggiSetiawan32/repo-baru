<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kode_kaprodi',
        'nip',
        'name'
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

}
