<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\user;

class KaprodiController extends Controller
{
    function index()
    {
        return view('kaprodi');
    }
    function kaprodi()
    {
        return view('kaprodi');
    }
    function dosen()
    {
        return view('kaprodi');
    }
    function dosen_wali()
    {
        return view('kaprodi');
    }
    function mahasiswa()
    {
        return view('kaprodi');
    }
    public function assignRolesToUsers(Request $request)
{
    $userIds = $request->input('user_ids'); // Misalnya, ID pengguna diambil dari input
    foreach ($userIds as $id) {
        $user = User::find($id);
        if ($user) {
            $user->assignRole('kaprodi,dosen,dosen_wali.mahasiswa'); // Atau peran lain sesuai kebutuhan
        }
    }
}

    
}
