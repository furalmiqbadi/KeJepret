<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function kejepret()
    {
        return view('kejepret');
    }

    public function search()
    {
        return view('search');
    }

    public function koleksi()
    {
        $user = auth()->user();
        if ($user && $user->role === 'fotografer') {
            // Data dummy untuk fotografer: manage penjualan
            $penjualan = [
                ['event'=>'Jakarta Marathon 2026','img'=>'photo-1552674605-db6ffd4facb5','harga'=>'50000','terjual'=>'5','pendapatan'=>'250000'],
                ['event'=>'Surabaya Night Run',   'img'=>'photo-1461896836934-bd45ba8fcf9b','harga'=>'30000','terjual'=>'3','pendapatan'=>'90000'],
                ['event'=>'Bali Fun Run',         'img'=>'photo-1571008887538-b36bb32f4571','harga'=>'40000','terjual'=>'2','pendapatan'=>'80000'],
            ];
            return view('koleksi', compact('penjualan'));
        } else {
            // Data dummy untuk user biasa
            $koleksi = [
                ['event'=>'Jakarta Marathon 2026','img'=>'photo-1552674605-db6ffd4facb5','km'=>'42K'],
                ['event'=>'Surabaya Night Run',   'img'=>'photo-1461896836934-bd45ba8fcf9b','km'=>'10K'],
                ['event'=>'Bali Fun Run',         'img'=>'photo-1571008887538-b36bb32f4571','km'=>'5K'],
                ['event'=>'Jakarta Marathon 2026','img'=>'photo-1486218119243-13883505764c','km'=>'42K'],
                ['event'=>'Surabaya Night Run',   'img'=>'photo-1594882645126-14020914d58d','km'=>'10K'],
                ['event'=>'Bali Fun Run',         'img'=>'photo-1513593771513-7b58b6c4af38','km'=>'5K'],
            ];
            return view('koleksi', compact('koleksi'));
        }
    }

    public function profil()
    {
        return view('profil');
    }
}
